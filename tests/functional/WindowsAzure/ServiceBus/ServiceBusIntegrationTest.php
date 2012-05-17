<?php

/**
 * Functional tests for the SDK
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
 * @category   Microsoft
 * @package    Tests\Functional\WindowsAzure\Services\ServiceBus
 * @author     Jason Cooke <jcooke@microsoft.com>
 * @copyright  2012 Microsoft Corporation
 * @license    http://www.apache.org/licenses/LICENSE-2.0  Apache License 2.0
 * @link       http://pear.php.net/package/azure-sdk-for-php
 */

namespace Tests\Functional\WindowsAzure\Services\ServiceBus;

use WindowsAzure\Services\ServiceBus\ServiceBusService;

use Tests\Functional\WindowsAzure\Services\ServiceBus\IntegrationTestBase;
use WindowsAzure\core\Builder;
use WindowsAzure\core\Builder\Alteration;
use WindowsAzure\core\Builder\Registry;
use WindowsAzure\core\Configuration;
use WindowsAzure\core\ServiceException;
use WindowsAzure\core\ServiceFilter;
use WindowsAzure\core\ServiceFilter\Request;
use WindowsAzure\core\ServiceFilter\Response;
use WindowsAzure\Services\ServiceBus\implementation\CorrelationFilter;
use WindowsAzure\Services\ServiceBus\implementation\EmptyRuleAction;
use WindowsAzure\Services\ServiceBus\implementation\FalseFilter;
use WindowsAzure\Services\ServiceBus\implementation\SqlFilter;
use WindowsAzure\Services\ServiceBus\implementation\SqlRuleAction;
use WindowsAzure\Services\ServiceBus\implementation\TrueFilter;
use WindowsAzure\Services\ServiceBus\models\BrokeredMessage;
use WindowsAzure\Services\ServiceBus\models\ListQueuesResult;
use WindowsAzure\Services\ServiceBus\models\ListRulesResult;
use WindowsAzure\Services\ServiceBus\models\ListSubscriptionsResult;
use WindowsAzure\Services\ServiceBus\models\ListTopicsResult;
use WindowsAzure\Services\ServiceBus\Models\QueueInfo;
use WindowsAzure\Services\ServiceBus\Models\QueueDescription;
use WindowsAzure\Services\ServiceBus\models\ReceiveMessageOptions;
use WindowsAzure\Services\ServiceBus\models\RuleInfo;
use WindowsAzure\Services\ServiceBus\models\SubscriptionInfo;
use WindowsAzure\Services\ServiceBus\models\TopicInfo;

class ServiceBusIntegrationTest extends IntegrationTestBase {

    //$RECEIVE_AND_DELETE_5_SECONDS = new ReceiveMessageOptions()->setReceiveAndDelete() ->setTimeout(5);
    //$PEEK_LOCK_5_SECONDS = new ReceiveMessageOptions()->setPeekLock()->setTimeout(5);

//    public function testCreateService() {
//        // reinitialize configuration from known state
//        $config = createConfiguration();
//
//        // applied as default configuration 
//        Configuration->setInstance($config);
//        $service = ServiceBusService->create();
//    }
//
//    /**
//    * @covers WindowsAzure\Services\ServiceBus\ServiceBusRestProxy::getQueue
//    * @covers WindowsAzure\Services\ServiceBus\ServiceBusRestProxy::listQueues
//    */
//    public function testFetchQueueAndListQueuesWorks() {
//        // Arrange
//        
//        // Act
//        $entry = $this->wrapper->getQueue('TestAlpha')->getValue();
//        $feed = $this->wrapper->listQueues();
//
//        // Assert
//        $this->assertNotNull($entry, '$entry');
//        $this->assertNotNull($feed, '$feed');
//    }
//
    /**
    * @covers WindowsAzure\Services\ServiceBus\ServiceBusRestProxy::createQueue
    */
    public function testCreateQueueWorks() {
        // Arrange

        // Act
        $queue = null;
        $queue = new QueueInfo('TestCreateQueueWorks');
        
        $queueDescription = new QueueDescription();
        $queueDescription->setMaxSizeInMegabytes(1024);
        
        try {
            $this->wrapper->deleteQueue('TestCreateQueueWorks');
        } catch (ServiceException $e) {
            // Ignore
        }
        $queue->setQueueDescription($queueDescription);
        $saved = $this->wrapper->createQueue($queue)->getValue();

        // Assert
        $this->assertNotNull($saved, '$saved');
        $this->assertNotSame($queue, $saved, 'queue and saved');
        $this->assertEquals('TestCreateQueueWorks', $saved->getPath(), '$saved->getPath()');
    }

    /**
    * @covers WindowsAzure\Services\ServiceBus\ServiceBusRestProxy::createQueue
    * @covers WindowsAzure\Services\ServiceBus\ServiceBusRestProxy::deleteQueue
    */
    public function testDeleteQueueWorks() {
        // Arrange
        try {
            $this->wrapper->createQueue(new QueueInfo('TestDeleteQueueWorks'));
        } catch (ServiceException $e) {
            // Ignore
        }

        // Act
        $this->wrapper->deleteQueue('TestDeleteQueueWorks');

        // Assert
    }

//    /**
//    * @covers WindowsAzure\Services\ServiceBus\ServiceBusRestProxy::sendQueueMessage
//    */
//    public function testSendMessageWorks() {
//        // Arrange
//        $message = new BrokeredMessage('sendMessageWorks');
//
//        // Act
//        $this->wrapper->sendQueueMessage('TestAlpha', $message);
//
//        // Assert
//    }
//
//    /**
//    * @covers WindowsAzure\Services\ServiceBus\ServiceBusRestProxy::createQueue
//    * @covers WindowsAzure\Services\ServiceBus\ServiceBusRestProxy::receiveQueueMessage
//    * @covers WindowsAzure\Services\ServiceBus\ServiceBusRestProxy::sendQueueMessage
//    */
//    public function testReceiveMessageWorks() {
//        // Arrange
//        $queueName = 'TestReceiveMessageWorks';
//        $this->wrapper->createQueue(new QueueInfo($queueName));
//        $this->wrapper->sendQueueMessage($queueName, new BrokeredMessage('Hello World'));
//
//        // Act
//        $message = $this->wrapper->receiveQueueMessage($queueName, $RECEIVE_AND_DELETE_5_SECONDS)->getValue();
//        $data = str_pad('', 100, chr(0));
//        $size = $message->getBody()->read($data);
//
//        // Assert
//        $this->assertEquals(11, $size, '$size');
//        $this->assertArrayEquals(substr($data, 0, $size), 'Hello World');
//    }
//
//    /**
//    * @covers WindowsAzure\Services\ServiceBus\ServiceBusRestProxy::createQueue
//    * @covers WindowsAzure\Services\ServiceBus\ServiceBusRestProxy::receiveQueueMessage
//    * @covers WindowsAzure\Services\ServiceBus\ServiceBusRestProxy::sendQueueMessage
//    */
//    public function testPeekLockMessageWorks() {
//        // Arrange
//        $queueName = 'TestPeekLockMessageWorks';
//        $this->wrapper->createQueue(new QueueInfo($queueName));
//        $this->wrapper->sendQueueMessage($queueName, new BrokeredMessage('Hello Again'));
//
//        // Act
//        $message = $this->wrapper->receiveQueueMessage($queueName, $PEEK_LOCK_5_SECONDS)->getValue();
//
//        // Assert
//        $data = str_pad('', 100, chr(0));
//        $size = $message->getBody()->read($data);
//        $this->assertEquals(11, $size, '$size');
//        $this->assertEquals('Hello Again', new String($data, 0, $size), 'new String($data, 0, $size)');
//    }
//
//    /**
//    * @covers WindowsAzure\Services\ServiceBus\ServiceBusRestProxy::createQueue
//    * @covers WindowsAzure\Services\ServiceBus\ServiceBusRestProxy::deleteMessage
//    * @covers WindowsAzure\Services\ServiceBus\ServiceBusRestProxy::receiveQueueMessage
//    * @covers WindowsAzure\Services\ServiceBus\ServiceBusRestProxy::sendQueueMessage
//    */
//    public function testPeekLockedMessageCanBeCompleted() {
//        // Arrange
//        $queueName = 'TestPeekLockedMessageCanBeCompleted';
//        $this->wrapper->createQueue(new QueueInfo($queueName));
//        $this->wrapper->sendQueueMessage($queueName, new BrokeredMessage('Hello Again'));
//        $message = $this->wrapper->receiveQueueMessage($queueName, $PEEK_LOCK_5_SECONDS)->getValue();
//
//        // Act
//        $lockToken = $message->getLockToken();
//        $lockedUntil = $message->getLockedUntilUtc();
//        $lockLocation = $message->getLockLocation();
//
//        $this->wrapper->deleteMessage($message);
//
//        // Assert
//        $this->assertNotNull($lockToken, '$lockToken');
//        $this->assertNotNull($lockedUntil, '$lockedUntil');
//        $this->assertNotNull($lockLocation, '$lockLocation');
//    }
//
//    /**
//    * @covers WindowsAzure\Services\ServiceBus\ServiceBusRestProxy::createQueue
//    * @covers WindowsAzure\Services\ServiceBus\ServiceBusRestProxy::receiveQueueMessage
//    * @covers WindowsAzure\Services\ServiceBus\ServiceBusRestProxy::sendQueueMessage
//    * @covers WindowsAzure\Services\ServiceBus\ServiceBusRestProxy::unlockMessage
//    */
//    public function testPeekLockedMessageCanBeUnlocked() {
//        // Arrange
//        $queueName = 'TestPeekLockedMessageCanBeUnlocked';
//        $this->wrapper->createQueue(new QueueInfo($queueName));
//        $this->wrapper->sendQueueMessage($queueName, new BrokeredMessage('Hello Again'));
//        $peekedMessage = $this->wrapper->receiveQueueMessage($queueName, $PEEK_LOCK_5_SECONDS)->getValue();
//
//        // Act
//        $lockToken = $peekedMessage->getLockToken();
//        $lockedUntil = $peekedMessage->getLockedUntilUtc();
//
//        $this->wrapper->unlockMessage($peekedMessage);
//        $receivedMessage = $this->wrapper->receiveQueueMessage($queueName, $RECEIVE_AND_DELETE_5_SECONDS) ->getValue();
//
//        // Assert
//        $this->assertNotNull($lockToken, '$lockToken');
//        $this->assertNotNull($lockedUntil, '$lockedUntil');
//        $this->assertNull($receivedMessage->getLockToken(), '$receivedMessage->getLockToken()');
//        $this->assertNull($receivedMessage->getLockedUntilUtc(), '$receivedMessage->getLockedUntilUtc()');
//    }
//
//    /**
//    * @covers WindowsAzure\Services\ServiceBus\ServiceBusRestProxy::createQueue
//    * @covers WindowsAzure\Services\ServiceBus\ServiceBusRestProxy::deleteMessage
//    * @covers WindowsAzure\Services\ServiceBus\ServiceBusRestProxy::receiveQueueMessage
//    * @covers WindowsAzure\Services\ServiceBus\ServiceBusRestProxy::sendQueueMessage
//    */
//    public function testPeekLockedMessageCanBeDeleted() {
//        // Arrange
//        $queueName = 'TestPeekLockedMessageCanBeDeleted';
//        $this->wrapper->createQueue(new QueueInfo($queueName));
//        $this->wrapper->sendQueueMessage($queueName, new BrokeredMessage('Hello Again'));
//        $peekedMessage = $this->wrapper->receiveQueueMessage($queueName, $PEEK_LOCK_5_SECONDS)->getValue();
//
//        // Act
//        $lockToken = $peekedMessage->getLockToken();
//        $lockedUntil = $peekedMessage->getLockedUntilUtc();
//
//        $this->wrapper->deleteMessage($peekedMessage);
//        $receivedMessage = $this->wrapper->receiveQueueMessage($queueName, $RECEIVE_AND_DELETE_5_SECONDS) ->getValue();
//
//        // Assert
//        $this->assertNotNull($lockToken, '$lockToken');
//        $this->assertNotNull($lockedUntil, '$lockedUntil');
//        $this->assertNull($receivedMessage->getLockToken(), '$receivedMessage->getLockToken()');
//        $this->assertNull($receivedMessage->getLockedUntilUtc(), '$receivedMessage->getLockedUntilUtc()');
//    }
//
//    /**
//    * @covers WindowsAzure\Services\ServiceBus\ServiceBusRestProxy::createQueue
//    * @covers WindowsAzure\Services\ServiceBus\ServiceBusRestProxy::receiveQueueMessage
//    * @covers WindowsAzure\Services\ServiceBus\ServiceBusRestProxy::sendQueueMessage
//    */
//    public function testContentTypePassesThrough() {
//        // Arrange
//        $queueName = 'TestContentTypePassesThrough';
//        $this->wrapper->createQueue(new QueueInfo($queueName));
//
//        // Act
//        $message = new BrokeredMessage('<data>Hello Again</data>');
//        $message->setContentType('text/xml');
//        $this->wrapper->sendQueueMessage($queueName, $message);
//
//        $message = $this->wrapper->receiveQueueMessage($queueName, $RECEIVE_AND_DELETE_5_SECONDS)->getValue();
//
//        // Assert
//        $this->assertNotNull($message, '$message');
//        $this->assertEquals('text/xml', $message->getContentType(), '$message->getContentType()');
//    }
//
//    /**
//    * @covers WindowsAzure\Services\ServiceBus\ServiceBusRestProxy::createTopic
//    * @covers WindowsAzure\Services\ServiceBus\ServiceBusRestProxy::deleteTopic
//    * @covers WindowsAzure\Services\ServiceBus\ServiceBusRestProxy::getTopic
//    * @covers WindowsAzure\Services\ServiceBus\ServiceBusRestProxy::listTopics
//    */
//    public function testTopicCanBeCreatedListedFetchedAndDeleted() {
//        // Arrange
//        $topicName = 'TestTopicCanBeCreatedListedFetchedAndDeleted';
//
//        // Act
//        $topic = new TopicInfo();
//        $topic->setPath($topicName);
//        $created = $this->wrapper->createTopic($topic)->getValue();
//        $listed = $this->wrapper->listTopics();
//        $fetched = $this->wrapper->getTopic($topicName)->getValue();
//        $this->wrapper->deleteTopic($topicName);
//        $listed2 = $this->wrapper->listTopics();
//
//        // Assert
//        $this->assertNotNull($created, '$created');
//        $this->assertNotNull($listed, '$listed');
//        $this->assertNotNull($fetched, '$fetched');
//        $this->assertNotNull($listed2, '$listed2');
//
//        $this->assertEquals($listed->getItems()->size() - 1, $listed2->getItems()->size(), '$listed2->getItems()->size()');
//    }
//
////    public function testFilterCanSeeAndChangeRequestOrResponse() {
////        // Arrange
////        $requests = array();
////        $responses = array();
////
////        $filtered = $this->wrapper->withFilter(new ServiceFilter() {
////            public Response handle($request, $next) {
////                array_push($requests, $request);
////                $response = next->handle($request);
////                array_push($responses, $response);
////                return $response;
////            }
////        });
////
////        // Act 
////        $created = filtered->createQueue(new QueueInfo('TestFilterCanSeeAndChangeRequestOrResponse'))->getValue();
////
////        // Assert
////        $this->assertNotNull($created, '$created');
////        $this->assertEquals(1, count(requests), 'requests->size()');
////        $this->assertEquals(1, count(responses), 'responses->size()');
////    }
//
//    /**
//    * @covers WindowsAzure\Services\ServiceBus\ServiceBusRestProxy::createSubscription
//    * @covers WindowsAzure\Services\ServiceBus\ServiceBusRestProxy::createTopic
//    */
//    public function testSubscriptionsCanBeCreatedOnTopics() {
//        // Arrange
//        $topicName = 'TestSubscriptionsCanBeCreatedOnTopics';
//        $this->wrapper->createTopic(new TopicInfo($topicName));
//
//        // Act
//        $created = $this->wrapper->createSubscription($topicName, new SubscriptionInfo('MySubscription')) ->getValue();
//
//        // Assert
//        $this->assertNotNull($created, '$created');
//        $this->assertEquals('MySubscription', $created->getName(), '$created->getName()');
//    }
//
//    /**
//    * @covers WindowsAzure\Services\ServiceBus\ServiceBusRestProxy::createSubscription
//    * @covers WindowsAzure\Services\ServiceBus\ServiceBusRestProxy::createTopic
//    * @covers WindowsAzure\Services\ServiceBus\ServiceBusRestProxy::listSubscriptions
//    */
//    public function testSubscriptionsCanBeListed() {
//        // Arrange
//        $topicName = 'TestSubscriptionsCanBeListed';
//        $this->wrapper->createTopic(new TopicInfo($topicName));
//        $this->wrapper->createSubscription($topicName, new SubscriptionInfo('MySubscription2'));
//
//        // Act
//        $result = $this->wrapper->listSubscriptions($topicName);
//
//        // Assert
//        $this->assertNotNull($result, '$result');
//        $this->assertEquals(1, $result->getItems()->size(), '$result->getItems()->size()');
//        $this->assertEquals('MySubscription2', $result->getItems()->get(0)->getName(), '$result->getItems()->get(0)->getName()');
//    }
//
//    /**
//    * @covers WindowsAzure\Services\ServiceBus\ServiceBusRestProxy::createSubscription
//    * @covers WindowsAzure\Services\ServiceBus\ServiceBusRestProxy::createTopic
//    * @covers WindowsAzure\Services\ServiceBus\ServiceBusRestProxy::getSubscription
//    */
//    public function testSubscriptionsDetailsMayBeFetched() {
//        // Arrange
//        $topicName = 'TestSubscriptionsDetailsMayBeFetched';
//        $this->wrapper->createTopic(new TopicInfo($topicName));
//        $this->wrapper->createSubscription($topicName, new SubscriptionInfo('MySubscription3'));
//
//        // Act
//        $result = $this->wrapper->getSubscription($topicName, 'MySubscription3')->getValue();
//
//        // Assert
//        $this->assertNotNull($result, '$result');
//        $this->assertEquals('MySubscription3', $result->getName(), '$result->getName()');
//    }
//
//    /**
//    * @covers WindowsAzure\Services\ServiceBus\ServiceBusRestProxy::createSubscription
//    * @covers WindowsAzure\Services\ServiceBus\ServiceBusRestProxy::createTopic
//    * @covers WindowsAzure\Services\ServiceBus\ServiceBusRestProxy::deleteSubscription
//    * @covers WindowsAzure\Services\ServiceBus\ServiceBusRestProxy::listSubscriptions
//    */
//    public function testSubscriptionsMayBeDeleted() {
//        // Arrange
//        $topicName = 'TestSubscriptionsMayBeDeleted';
//        $this->wrapper->createTopic(new TopicInfo($topicName));
//        $this->wrapper->createSubscription($topicName, new SubscriptionInfo('MySubscription4'));
//        $this->wrapper->createSubscription($topicName, new SubscriptionInfo('MySubscription5'));
//
//        // Act
//        $this->wrapper->deleteSubscription($topicName, 'MySubscription4');
//
//        // Assert
//        $result = $this->wrapper->listSubscriptions($topicName);
//        $this->assertNotNull($result, '$result');
//        $this->assertEquals(1, $result->getItems()->size(), '$result->getItems()->size()');
//        $this->assertEquals('MySubscription5', $result->getItems()->get(0)->getName(), '$result->getItems()->get(0)->getName()');
//    }
//
//    /**
//    * @covers WindowsAzure\Services\ServiceBus\ServiceBusRestProxy::createSubscription
//    * @covers WindowsAzure\Services\ServiceBus\ServiceBusRestProxy::createTopic
//    * @covers WindowsAzure\Services\ServiceBus\ServiceBusRestProxy::receiveSubscriptionMessage
//    * @covers WindowsAzure\Services\ServiceBus\ServiceBusRestProxy::sendTopicMessage
//    */
//    public function testSubscriptionWillReceiveMessage() {
//        // Arrange
//        $topicName = 'TestSubscriptionWillReceiveMessage';
//        $this->wrapper->createTopic(new TopicInfo($topicName));
//        $this->wrapper->createSubscription($topicName, new SubscriptionInfo('sub'));
//        $message = new BrokeredMessage('<p>Testing subscription</p>');
//        $message->setContentType('text/html');
//        $this->wrapper->sendTopicMessage($topicName, $message);
//
//        // Act
//        $message = $this->wrapper->receiveSubscriptionMessage($topicName, 'sub', $RECEIVE_AND_DELETE_5_SECONDS) ->getValue();
//
//        // Assert
//        $this->assertNotNull($message, '$message');
//
//        $data = str_pad('', 100, chr(0));
//        $size = $message->getBody()->read($data);
//        $this->assertEquals('<p>Testing subscription</p>', new String($data, 0, $size), 'new String($data, 0, $size)');
//        $this->assertEquals('text/html', $message->getContentType(), '$message->getContentType()');
//    }
//
//    /**
//    * @covers WindowsAzure\Services\ServiceBus\ServiceBusRestProxy::createRule
//    * @covers WindowsAzure\Services\ServiceBus\ServiceBusRestProxy::createSubscription
//    * @covers WindowsAzure\Services\ServiceBus\ServiceBusRestProxy::createTopic
//    */
//    public function testRulesCanBeCreatedOnSubscriptions() {
//        // Arrange
//        $topicName = 'TestrulesCanBeCreatedOnSubscriptions';
//        $this->wrapper->createTopic(new TopicInfo($topicName));
//        $this->wrapper->createSubscription($topicName, new SubscriptionInfo('sub'));
//
//        // Act
//        $created = $this->wrapper->createRule($topicName, 'sub', new RuleInfo('MyRule1'))->getValue();
//
//        // Assert
//        $this->assertNotNull($created, '$created');
//        $this->assertEquals('MyRule1', $created->getName(), '$created->getName()');
//    }
//
//    /**
//    * @covers WindowsAzure\Services\ServiceBus\ServiceBusRestProxy::createRule
//    * @covers WindowsAzure\Services\ServiceBus\ServiceBusRestProxy::createSubscription
//    * @covers WindowsAzure\Services\ServiceBus\ServiceBusRestProxy::createTopic
//    * @covers WindowsAzure\Services\ServiceBus\ServiceBusRestProxy::listRules
//    */
//    public function testRulesCanBeListedAndDefaultRuleIsPrecreated() {
//        // Arrange
//        $topicName = 'TestrulesCanBeListedAndDefaultRuleIsPrecreated';
//        $this->wrapper->createTopic(new TopicInfo($topicName));
//        $this->wrapper->createSubscription($topicName, new SubscriptionInfo('sub'));
//        $this->wrapper->createRule($topicName, 'sub', new RuleInfo('MyRule2'));
//
//        // Act
//        $result = $this->wrapper->listRules($topicName, 'sub');
//
//        // Assert
//        $this->assertNotNull($result, '$result');
//        $this->assertEquals(2, $result->getItems()->size(), '$result->getItems()->size()');
//        $rule0 = $result->getItems()->get(0);
//        $rule1 = $result->getItems()->get(1);
//        if ($rule0->getName() == 'MyRule2') {
//            $swap = $rule1;
//            $rule1 = $rule0;
//            $rule0 = $swap;
//        }
//
//        $this->assertEquals('$Default', $rule0->getName(), '$rule0->getName()');
//        $this->assertEquals('MyRule2', $rule1->getName(), '$rule1->getName()');
//        $this->assertNotNull($result->getItems()->get(0)->getModel(), '$result->getItems()->get(0)->getModel()');
//    }
//
//    /**
//    * @covers WindowsAzure\Services\ServiceBus\ServiceBusRestProxy::createSubscription
//    * @covers WindowsAzure\Services\ServiceBus\ServiceBusRestProxy::createTopic
//    * @covers WindowsAzure\Services\ServiceBus\ServiceBusRestProxy::getRule
//    */
//    public function testRuleDetailsMayBeFetched() {
//        // Arrange
//        $topicName = 'TestruleDetailsMayBeFetched';
//        $this->wrapper->createTopic(new TopicInfo($topicName));
//        $this->wrapper->createSubscription($topicName, new SubscriptionInfo('sub'));
//
//        // Act
//        $result = $this->wrapper->getRule($topicName, 'sub', '$Default')->getValue();
//
//        // Assert
//        $this->assertNotNull($result, '$result');
//        $this->assertEquals('$Default', $result->getName(), '$result->getName()');
//    }
//
//    /**
//    * @covers WindowsAzure\Services\ServiceBus\ServiceBusRestProxy::createRule
//    * @covers WindowsAzure\Services\ServiceBus\ServiceBusRestProxy::createSubscription
//    * @covers WindowsAzure\Services\ServiceBus\ServiceBusRestProxy::createTopic
//    * @covers WindowsAzure\Services\ServiceBus\ServiceBusRestProxy::deleteRule
//    * @covers WindowsAzure\Services\ServiceBus\ServiceBusRestProxy::listRules
//    */
//    public function testRulesMayBeDeleted() {
//        // Arrange
//        $topicName = 'TestRulesMayBeDeleted';
//        $this->wrapper->createTopic(new TopicInfo($topicName));
//        $this->wrapper->createSubscription($topicName, new SubscriptionInfo('sub'));
//        $this->wrapper->createRule($topicName, 'sub', new RuleInfo('MyRule4'));
//        $this->wrapper->createRule($topicName, 'sub', new RuleInfo('MyRule5'));
//
//        // Act
//        $this->wrapper->deleteRule($topicName, 'sub', 'MyRule5');
//        $this->wrapper->deleteRule($topicName, 'sub', '$Default');
//
//        // Assert
//        $result = $this->wrapper->listRules($topicName, 'sub');
//        $this->assertNotNull($result, '$result');
//        $this->assertEquals(1, $result->getItems()->size(), '$result->getItems()->size()');
//        $this->assertEquals('MyRule4', $result->getItems()->get(0)->getName(), '$result->getItems()->get(0)->getName()');
//    }
//
//    /**
//    * @covers WindowsAzure\Services\ServiceBus\ServiceBusRestProxy::createRule
//    * @covers WindowsAzure\Services\ServiceBus\ServiceBusRestProxy::createSubscription
//    * @covers WindowsAzure\Services\ServiceBus\ServiceBusRestProxy::createTopic
//    */
//    public function testRulesMayHaveActionAndFilter() {
//        // Arrange
//        $topicName = 'TestRulesMayHaveAnActionAndFilter';
//        $this->wrapper->createTopic(new TopicInfo($topicName));
//        $this->wrapper->createSubscription($topicName, new SubscriptionInfo('sub'));
//
//        // Act
//        $ruleInfoOne = new RuleInfo('One');
//        $ruleInfoOne->withCorrelationIdFilter('my-id');
//        $ruleOne = $this->wrapper->createRule($topicName, 'sub', $ruleInfoOne) ->getValue();
//        $ruleInfoTwo = new RuleInfo('Two');
//        $ruleInfoTwo->withTrueFilter();
//        $ruleTwo = $this->wrapper->createRule($topicName, 'sub', $ruleInfoTwo)->getValue();
//        $ruleInfoThree = new RuleInfo('Three');
//        $ruleInfoThree->withFalseFilter();
//        $ruleThree = $this->wrapper->createRule($topicName, 'sub', $ruleInfoThree)->getValue();
//        $ruleInfoFour = new RuleInfo('Four');
//        $ruleInfoFour->withEmptyRuleAction();
//        $ruleFour = $this->wrapper->createRule($topicName, 'sub', $ruleInfoFour)->getValue();
//        $ruleInfoFive = new RuleInfo('Five');
//        $ruleInfoFive->withSqlRuleAction('SET x = 5');
//        $ruleFive = $this->wrapper->createRule($topicName, 'sub', $ruleInfoFive) ->getValue();
//        $ruleInfoSix = new RuleInfo('Six');
//        $ruleInfoSix->withSqlExpressionFilter('x != 5');
//        $ruleSix = $this->wrapper->createRule($topicName, 'sub', $ruleInfoSix) ->getValue();
//
//        // Assert
//        $this->assertEquals($ruleOne->getFilter() instanceof CorrelationFilter, '$ruleOne->getFilter()->getClass()');
//        $this->assertEquals($ruleTwo->getFilter() instanceof TrueFilter, '$ruleTwo->getFilter()->getClass()');
//        $this->assertEquals($ruleThree->getFilter() instanceof FalseFilter, '$ruleThree->getFilter()->getClass()');
//        $this->assertEquals($ruleFour->getAction() instanceof EmptyRuleAction, '$ruleFour->getAction()->getClass()');
//        $this->assertEquals($ruleFive->getAction() instanceof SqlRuleAction, '$ruleFive->getAction()->getClass()');
//        $this->assertEquals($ruleSix->getFilter() instanceof SqlFilter, '$ruleSix->getFilter()->getClass()');
//    }
//
//    /**
//    * @covers WindowsAzure\Services\ServiceBus\ServiceBusRestProxy::createQueue
//    * @covers WindowsAzure\Services\ServiceBus\ServiceBusRestProxy::receiveQueueMessage
//    * @covers WindowsAzure\Services\ServiceBus\ServiceBusRestProxy::sendQueueMessage
//    */
//    public function testMessagesMayHaveCustomProperties() {
//        // Arrange
//        $queueName = 'TestMessagesMayHaveCustomProperties';
//        $this->wrapper->createQueue(new QueueInfo($queueName));
//
//        // Act
//        $message = new BrokeredMessage('');
//        $message->setProperty('hello', 'world');
//        $message->setProperty('foo', 42);
//        $this->wrapper->sendQueueMessage($queueName, $message);
//        $message = $this->wrapper->receiveQueueMessage($queueName, $RECEIVE_AND_DELETE_5_SECONDS)->getValue();
//
//        // Assert
//        $this->assertEquals('world', $message->getProperty('hello'), '$message->getProperty(\'hello\')');
//        $this->assertEquals(42, $message->getProperty('foo'), '$message->getProperty(\'foo\')');
//    }
}
?>
