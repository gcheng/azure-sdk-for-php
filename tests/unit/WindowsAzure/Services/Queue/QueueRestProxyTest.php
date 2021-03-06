<?php

/**
 * Unit tests for the SDK
 *
 * PHP version 5
 *
 * LICENSE: Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 * http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 *
 * @package    WindowsAzure-sdk-for-php
 * @author     Abdelrahman Elogeel <Abdelrahman.Elogeel@microsoft.com>
 * @copyright  2012 Microsoft Corporation
 * @license    http://www.apache.org/licenses/LICENSE-2.0  Apache License 2.0
 * @link       http://pear.php.net/package/azure-sdk-for-php
 */
namespace PEAR2\Tests\Unit\WindowsAzure\Services\Queue\QueueRestProxy;
use PEAR2\WindowsAzure\Core\WindowsAzureUtilities;
use PEAR2\Tests\Framework\QueueRestProxyTestBase;
use PEAR2\WindowsAzure\Services\Core\Configuration;
use PEAR2\WindowsAzure\Services\Core\Models\ServiceProperties;
use PEAR2\WindowsAzure\Services\Queue\QueueRestProxy;
use PEAR2\WindowsAzure\Services\Queue\IQueue;
use PEAR2\WindowsAzure\Services\Queue\QueueService;
use PEAR2\WindowsAzure\Services\Queue\QueueSettings;
use PEAR2\WindowsAzure\Services\Queue\Models\ListQueuesOptions;
use PEAR2\WindowsAzure\Services\Queue\Models\ListQueuesResult;
use PEAR2\WindowsAzure\Services\Queue\Models\CreateQueueOptions;
use PEAR2\WindowsAzure\Services\Queue\Models\GetQueueMetadataResult;
use PEAR2\WindowsAzure\Services\Queue\Models\ListMessagesResult;
use PEAR2\WindowsAzure\Services\Queue\Models\ListMessagesOptions;
use PEAR2\WindowsAzure\Services\Queue\Models\PeekMessagesResult;
use PEAR2\WindowsAzure\Services\Queue\Models\PeekMessagesOptions;
use PEAR2\WindowsAzure\Services\Queue\Models\UpdateMessageResult;
use PEAR2\WindowsAzure\Services\Queue\Models\QueueServiceOptions;
use PEAR2\Tests\Framework\TestResources;
use PEAR2\WindowsAzure\Resources;
use PEAR2\WindowsAzure\Core\ServiceException;

/**
* Unit tests for QueueRestProxy class
*
* @package    WindowsAzure-sdk-for-php
* @author     Abdelrahman Elogeel <Abdelrahman.Elogeel@microsoft.com>
* @copyright  2012 Microsoft Corporation
* @license    http://www.apache.org/licenses/LICENSE-2.0  Apache License 2.0
* @version    Release: @package_version@
* @link       http://pear.php.net/package/azure-sdk-for-php
*/
class QueueRestProxyTest extends QueueRestProxyTestBase
{
    /**
     * @covers PEAR2\WindowsAzure\Services\Queue\QueueRestProxy::listQueues
     * @covers PEAR2\WindowsAzure\Services\Core\ServiceRestProxy::send
     */
    public function testListQueuesSimple()
    {
        // Setup
        $queue1 = 'listqueuesimple1';
        $queue2 = 'listqueuesimple2';
        $queue3 = 'listqueuesimple3';

        parent::createQueue($queue1);
        parent::createQueue($queue2);
        parent::createQueue($queue3);
        
        // Test
        $result = $this->wrapper->listQueues();

        // Assert
        $queues = $result->getQueues();
        $this->assertEquals($queue1, $queues[0]->getName());
        $this->assertEquals($queue2, $queues[1]->getName());
        $this->assertEquals($queue3, $queues[2]->getName());
    }

    /**
    * @covers PEAR2\WindowsAzure\Services\Queue\QueueRestProxy::listQueues
    */
    public function testListQueuesWithOptions()
    {
        // Setup
        $queue1        = 'listqueuewithoptions1';
        $queue2        = 'listqueuewithoptions2';
        $queue3        = 'mlistqueuewithoptions3';
        $metadataName  = 'Mymetadataname';
        $metadataValue = 'MetadataValue';
        $options = new CreateQueueOptions();
        $options->addMetadata($metadataName, $metadataValue);
        parent::createQueue($queue1);
        parent::createQueue($queue2, $options);
        parent::createQueue($queue3);
        $options = new ListQueuesOptions();
        $options->setPrefix('list');
        $options->setIncludeMetadata(true);
        
        // Test
        $result = $this->wrapper->listQueues($options);
        
        // Assert
        $queues   = $result->getQueues();
        $metadata = $queues[1]->getMetadata();
        $this->assertEquals(2, count($queues));
        $this->assertEquals($queue1, $queues[0]->getName());
        $this->assertEquals($queue2, $queues[1]->getName());
        $this->assertEquals($metadataValue, $metadata[$metadataName]);
    }

    /**
    * @covers PEAR2\WindowsAzure\Services\Queue\QueueRestProxy::listQueues
    */
    public function testListQueuesWithNextMarker()
    {
        // Setup
        $queue1 = 'listqueueswithnextmarker1';
        $queue2 = 'listqueueswithnextmarker2';
        $queue3 = 'listqueueswithnextmarker3';
        parent::createQueue($queue1);
        parent::createQueue($queue2);
        parent::createQueue($queue3);
        $options = new ListQueuesOptions();
        $options->setMaxResults('2');
        
        // Test
        $result = $this->wrapper->listQueues($options);
        
        // Assert
        $queues = $result->getQueues();
        $this->assertEquals(2, count($queues));
        $this->assertEquals($queue1, $queues[0]->getName());
        $this->assertEquals($queue2, $queues[1]->getName());
        
        // Test
        $options->setMarker($result->getNextMarker());
        $result = $this->wrapper->listQueues($options);
        $queues = $result->getQueues();

        // Assert
        $this->assertEquals(1, count($queues));
        $this->assertEquals($queue3, $queues[0]->getName());
    }
    
    /**
    * @covers PEAR2\WindowsAzure\Services\Queue\QueueRestProxy::listQueues
    */
    public function testListQueuesWithInvalidNextMarkerFail()
    {
        if (WindowsAzureUtilities::isEmulated()) {
            $this->markTestSkipped(self::NOT_SUPPORTED);
        }
        
        // Setup
        $queue1 = 'listqueueswithinvalidnextmarker1';
        $queue2 = 'listqueueswithinvalidnextmarker2';
        $queue3 = 'listqueueswithinvalidnextmarker3';
        parent::createQueue($queue1);
        parent::createQueue($queue2);
        parent::createQueue($queue3);
        $options = new ListQueuesOptions();
        $options->setMaxResults('2');
        $this->setExpectedException(get_class(new ServiceException('409')));
        
        // Test
        $this->wrapper->listQueues($options);
        $options->setMarker('wrong marker');
        $this->wrapper->listQueues($options);
    }

    /**
    * @covers PEAR2\WindowsAzure\Services\Queue\QueueRestProxy::listQueues
    */
    public function testListQueuesWithNoQueues()
    {
        // Test
        $result = $this->wrapper->listQueues();
        
        // Assert
        $queues = $result->getQueues();
        $this->assertTrue(empty($queues));
    }

    /**
    * @covers PEAR2\WindowsAzure\Services\Queue\QueueRestProxy::listQueues
    */
    public function testListQueuesWithOneResult()
    {
        // Setup
        $queueName = 'listqueueswithoneresult';
        parent::createQueue($queueName);
        
        // Test
        $result = $this->wrapper->listQueues();
        $queues = $result->getQueues();

        // Assert
        $this->assertEquals(1, count($queues));
    }

    /**
    * @covers PEAR2\WindowsAzure\Services\Queue\QueueRestProxy::createQueue
    */
    public function testCreateQueueSimple()
    {
        // Setup
        $queueName = 'createqueuesimple';
        
        // Test
        $this->createQueue($queueName);
        
        // Assert
        $result = $this->wrapper->listQueues();
        $queues = $result->getQueues();
        $this->assertEquals(1, count($queues));
        $this->assertEquals($queues[0]->getName(), $queueName);
    }
    
    /**
    * @covers PEAR2\WindowsAzure\Services\Queue\QueueRestProxy::createQueue
    */
    public function testCreateQueueWithMetadata()
    {
        $queueName     = 'createqueuewithmetadata';
        $metadataName  = 'Name';
        $metadataValue = 'MyName';
        $queueCreateOptions = new CreateQueueOptions();
        $queueCreateOptions->addMetadata($metadataName, $metadataValue);
        
        // Test
        $this->createQueue($queueName, $queueCreateOptions);

        // Assert
        $options = new ListQueuesOptions();
        $options->setIncludeMetadata(true);
        $result   = $this->wrapper->listQueues($options);
        $queues   = $result->getQueues();
        $metadata = $queues[0]->getMetadata();
        $this->assertEquals($metadataValue, $metadata[$metadataName]);
    }
    
    /**
    * @covers PEAR2\WindowsAzure\Services\Queue\QueueRestProxy::createQueue
    */
    public function testCreateQueueInvalidNameFail()
    {
        // Setup
        $queueName = 'CreateQueueInvalidNameFail';
        $this->setExpectedException(get_class(new ServiceException('400')));
        
        // Test
        $this->createQueue($queueName);
    }
    
    /**
    * @covers PEAR2\WindowsAzure\Services\Queue\QueueRestProxy::createQueue
    */
    public function testCreateQueueAlreadyExitsFail()
    {
        // Setup
        $queueName = 'createqueuealreadyexitsfail';
        $this->setExpectedException(get_class(new ServiceException('204')));
        $this->createQueue($queueName);

        // Test
        $this->createQueue($queueName);
    }
    
    /**
    * @covers PEAR2\WindowsAzure\Services\Queue\QueueRestProxy::deleteQueue
    */
    public function testDeleteQueue()
    {
        // Setup
        $queueName = 'deletequeue';
        $this->wrapper->createQueue($queueName);
        
        // Test
        $this->wrapper->deleteQueue($queueName);
        
        // Assert
        $result = $this->wrapper->listQueues();
        $queues = $result->getQueues();
        $this->assertTrue(empty($queues));
    }
    
    /**
    * @covers PEAR2\WindowsAzure\Services\Queue\QueueRestProxy::deleteQueue
    */
    public function testDeleteQueueFail()
    {
        // Setup
        $queueName = 'deletequeuefail';
        $this->setExpectedException(get_class(new ServiceException('404')));
        
        // Test
        $this->wrapper->deleteQueue($queueName);
    }
    
    /**
    * @covers PEAR2\WindowsAzure\Services\Queue\QueueRestProxy::getServiceProperties
    */
    public function testGetServiceProperties()
    {
        if (WindowsAzureUtilities::isEmulated()) {
            $this->markTestSkipped(self::NOT_SUPPORTED);
        }
        
        // Test
        $result = $this->wrapper->getServiceProperties();
        
        // Assert
        $this->assertEquals($this->defaultProperties->toArray(), $result->getValue()->toArray());
    }
    
    /**
    * @covers PEAR2\WindowsAzure\Services\Queue\QueueRestProxy::setServiceProperties
    */
    public function testSetServiceProperties()
    {
        if (WindowsAzureUtilities::isEmulated()) {
            $this->markTestSkipped(self::NOT_SUPPORTED);
        }
        
        // Setup
        $expected = ServiceProperties::create(TestResources::setServicePropertiesSample());
        
        // Test
        $this->setServiceProperties($expected);
        $actual = $this->wrapper->getServiceProperties();
        
        // Assert
        $this->assertEquals($expected->toXml(), $actual->getValue()->toXml());
    }
    
    /**
    * @covers PEAR2\WindowsAzure\Services\Queue\QueueRestProxy::getQueueMetadata
    */
    public function testGetQueueMetadata()
    {
        // Setup
        $name     = 'getqueuemetadata';
        $expectedCount = 0;
        $options  = new CreateQueueOptions();
        $expected = array ('name1' => 'MyName1', 'mymetaname' => '12345', 'values' => 'Microsoft_');
        $options->setMetadata($expected);
        $this->createQueue($name, $options);
        
        // Test
        $result = $this->wrapper->getQueueMetadata($name);
        
        // Assert
        $this->assertEquals($expectedCount, $result->getApproximateMessageCount());
        $this->assertEquals($expected, $result->getMetadata());
    }
    
    /**
    * @covers PEAR2\WindowsAzure\Services\Queue\QueueRestProxy::setQueueMetadata
    */
    public function testSetQueueMetadata()
    {
        // Setup
        $name = 'setqueuemetadata';
        $expected = array ('name1' => 'MyName1', 'mymetaname' => '12345', 'values' => 'Microsoft_');
        $this->createQueue($name);
        
        // Test
        $this->wrapper->setQueueMetadata($name, $expected);
        $actual = $this->wrapper->getQueueMetadata($name);
        
        // Assert
        $this->assertEquals($expected, $actual->getMetadata());
    }
    
    /**
     * @covers PEAR2\WindowsAzure\Services\Queue\QueueRestProxy::createMessage
     * @covers PEAR2\WindowsAzure\Services\Core\ServiceRestProxy::send
     */
    public function testCreateMessage()
    {
        // Setup
        $name = 'createmessage';
        $expected = 'this is message text';
        $this->createQueue($name);
        
        // Test
        $this->wrapper->createMessage($name, $expected);
        
        // Assert
        $result = $this->wrapper->listMessages($name);
        $messages = $result->getQueueMessages();
        $actual = $messages[0]->getMessageText();
        $this->assertEquals($expected, $actual);
    }
    
    /**
    * @covers PEAR2\WindowsAzure\Services\Queue\QueueRestProxy::listMessages
    */
    public function testListMessagesEmpty()
    {
        // Setup
        $name = 'listmessagesempty';
        $this->createQueue($name);

        // Test
        $result = $this->wrapper->listMessages($name);        
        
        // Assert
        $actual = $result->getQueueMessages();
        $this->assertEmpty($actual);
    }
    
    /**
    * @covers PEAR2\WindowsAzure\Services\Queue\QueueRestProxy::listMessages
    */
    public function testListMessagesOneMessage()
    {
        // Setup
        $name = 'listmessagesonemessage';
        $this->createQueue($name);
        $expected = 'Message text';
        $this->wrapper->createMessage($name, $expected);
        
        // Test
        $result = $this->wrapper->listMessages($name);        
        
        // Assert
        $messages = $result->getQueueMessages();
        $actual = $messages[0];
        $this->assertCount(1, $messages);
        $this->assertEquals($expected, $actual->getMessageText());
    }
    
    /**
    * @covers PEAR2\WindowsAzure\Services\Queue\QueueRestProxy::listMessages
    */
    public function testListMessagesCreateMultiplesReturnOne()
    {
        // Setup
        $name = 'listmessagescreatemultiplesreturnone';
        $this->createQueue($name);
        $expected1 = 'Message #1 Text';
        $message2 = 'Message #2 Text';
        $message3 = 'Message #3 Text';
        $this->wrapper->createMessage($name, $expected1);
        $this->wrapper->createMessage($name, $message2);
        $this->wrapper->createMessage($name, $message3);
        
        // Test
        $result = $this->wrapper->listMessages($name);
        
        // Assert
        $actual = $result->getQueueMessages();
        $this->assertCount(1, $actual);
        $this->assertEquals($expected1, $actual[0]->getMessageText());
    }
    
    /**
    * @covers PEAR2\WindowsAzure\Services\Queue\QueueRestProxy::listMessages
    */
    public function testListMessagesMultiplesMessages()
    {
        // Setup
        $name = 'listmessagesmultiplesmessages';
        $this->createQueue($name);
        $expected1 = 'Message #1 Text';
        $expected2 = 'Message #2 Text';
        $expected3 = 'Message #3 Text';
        $this->wrapper->createMessage($name, $expected1);
        $this->wrapper->createMessage($name, $expected2);
        $this->wrapper->createMessage($name, $expected3);
        $options = new ListMessagesOptions();
        $options->setNumberOfMessages(10);
        
        // Test
        $result = $this->wrapper->listMessages($name, $options);
        
        // Assert
        $actual = $result->getQueueMessages();
        $this->assertCount(3, $actual);
        $this->assertEquals($expected1, $actual[0]->getMessageText());
        $this->assertEquals($expected2, $actual[1]->getMessageText());
        $this->assertEquals($expected3, $actual[2]->getMessageText());
    }
    
    /**
    * @covers PEAR2\WindowsAzure\Services\Queue\QueueRestProxy::peekMessages
    */
    public function testPeekMessagesEmpty()
    {
        // Setup
        $name = 'peekmessagesempty';
        $this->createQueue($name);

        // Test
        $result = $this->wrapper->peekMessages($name);        
        
        // Assert
        $actual = $result->getQueueMessages();
        $this->assertEmpty($actual);
    }
    
    /**
    * @covers PEAR2\WindowsAzure\Services\Queue\QueueRestProxy::peekMessages
    */
    public function testPeekMessagesOneMessage()
    {
        // Setup
        $name = 'peekmessagesonemessage';
        $this->createQueue($name);
        $expected = 'Message text';
        $this->wrapper->createMessage($name, $expected);
        
        // Test
        $result = $this->wrapper->peekMessages($name);        
        
        // Assert
        $messages = $result->getQueueMessages();
        $actual = $messages[0];
        $this->assertCount(1, $messages);
        $this->assertEquals($expected, $actual->getMessageText());
    }
    
    /**
    * @covers PEAR2\WindowsAzure\Services\Queue\QueueRestProxy::peekMessages
    */
    public function testPeekMessagesCreateMultiplesReturnOne()
    {
        // Setup
        $name = 'peekmessagescreatemultiplesreturnone';
        $this->createQueue($name);
        $expected1 = 'Message #1 Text';
        $message2 = 'Message #2 Text';
        $message3 = 'Message #3 Text';
        $this->wrapper->createMessage($name, $expected1);
        $this->wrapper->createMessage($name, $message2);
        $this->wrapper->createMessage($name, $message3);
        
        // Test
        $result = $this->wrapper->peekMessages($name);
        
        // Assert
        $actual = $result->getQueueMessages();
        $this->assertCount(1, $actual);
        $this->assertEquals($expected1, $actual[0]->getMessageText());
    }
    
    /**
    * @covers PEAR2\WindowsAzure\Services\Queue\QueueRestProxy::peekMessages
    */
    public function testPeekMessagesMultiplesMessages()
    {
        // Setup
        $name = 'peekmessagesmultiplesmessages';
        $this->createQueue($name);
        $expected1 = 'Message #1 Text';
        $expected2 = 'Message #2 Text';
        $expected3 = 'Message #3 Text';
        $this->wrapper->createMessage($name, $expected1);
        $this->wrapper->createMessage($name, $expected2);
        $this->wrapper->createMessage($name, $expected3);
        $options = new PeekMessagesOptions();
        $options->setNumberOfMessages(10);
        
        // Test
        $result = $this->wrapper->peekMessages($name, $options);
        
        // Assert
        $actual = $result->getQueueMessages();
        $this->assertCount(3, $actual);
        $this->assertEquals($expected1, $actual[0]->getMessageText());
        $this->assertEquals($expected2, $actual[1]->getMessageText());
        $this->assertEquals($expected3, $actual[2]->getMessageText());
    }
    
    /**
    * @covers PEAR2\WindowsAzure\Services\Queue\QueueRestProxy::deleteMessage
    */
    public function testDeleteMessage()
    {
        // Setup
        $name = 'deletemessage';
        $expected = 'this is message text';
        $this->createQueue($name);
        $this->wrapper->createMessage($name, $expected);
        $result = $this->wrapper->listMessages($name);
        $messages   = $result->getQueueMessages();
        $messageId  = $messages[0]->getMessageId();
        $popReceipt = $messages[0]->getPopReceipt();
        
        // Test
        $this->wrapper->deleteMessage($name, $messageId, $popReceipt);
        
        // Assert
        $result   = $this->wrapper->listMessages($name);
        $messages = $result->getQueueMessages();
        $this->assertTrue(empty($messages));
    }
    
    /**
     * @covers PEAR2\WindowsAzure\Services\Queue\QueueRestProxy::clearMessages
     * @covers PEAR2\WindowsAzure\Services\Core\ServiceRestProxy::send
     */
    public function testClearMessagesWithOptions()
    {
        // Setup
        $name = 'clearmessageswithoptions';
        $msg1 = 'message #1';
        $msg2 = 'message #2';
        $msg3 = 'message #3';
        $options = new QueueServiceOptions();
        $options->setTimeout('10');
        $this->createQueue($name);
        $this->wrapper->createMessage($name, $msg1);
        $this->wrapper->createMessage($name, $msg2);
        $this->wrapper->createMessage($name, $msg3);
        
        // Test
        $this->wrapper->clearMessages($name, $options);
        
        // Assert
        $result   = $this->wrapper->listMessages($name);
        $messages = $result->getQueueMessages();
        $this->assertTrue(empty($messages));
    }
    
    /**
     * @covers PEAR2\WindowsAzure\Services\Queue\QueueRestProxy::clearMessages
     * @covers PEAR2\WindowsAzure\Services\Core\ServiceRestProxy::send
     */
    public function testClearMessages()
    {
        // Setup
        $name = 'clearmessages';
        $msg1 = 'message #1';
        $msg2 = 'message #2';
        $msg3 = 'message #3';
        $this->createQueue($name);
        $this->wrapper->createMessage($name, $msg1);
        $this->wrapper->createMessage($name, $msg2);
        $this->wrapper->createMessage($name, $msg3);
        
        // Test
        $this->wrapper->clearMessages($name);
        
        // Assert
        $result   = $this->wrapper->listMessages($name);
        $messages = $result->getQueueMessages();
        $this->assertTrue(empty($messages));
    }
    
    /**
    * @covers PEAR2\WindowsAzure\Services\Queue\QueueRestProxy::updateMessage
    */
    public function testUpdateMessage()
    {
        // Setup
        $name = 'updatemessage';
        $expectedText = 'this is message text';
        $expectedVisibility = 10;
        $this->createQueue($name);
        $this->wrapper->createMessage($name, 'Text to change');
        $result = $this->wrapper->listMessages($name);
        $messages   = $result->getQueueMessages();
        $popReceipt = $messages[0]->getPopReceipt();
        $messageId = $messages[0]->getMessageId();
        
        // Test
        $result = $this->wrapper->UpdateMessage($name, $messageId, $popReceipt, 
            $expectedText, $expectedVisibility);
        
        // Assert
        $result   = $this->wrapper->listMessages($name);
        $messages = $result->getQueueMessages();
        $this->assertTrue(empty($messages));
        
        sleep($expectedVisibility);
        
        $result   = $this->wrapper->listMessages($name);
        $messages = $result->getQueueMessages();
        $actual   = $messages[0];
        $this->assertEquals($expectedText, $actual->getMessageText());
    }
}

?>
