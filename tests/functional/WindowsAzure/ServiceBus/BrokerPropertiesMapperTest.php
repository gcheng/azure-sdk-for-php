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

use Tests\Framework\ServiceBusRestProxyTestBase;
use WindowsAzure\Resources;
use WindowsAzure\Core\Configuration;
use WindowsAzure\Services\ServiceBus\ServiceBusRestProxy;
use WindowsAzure\Services\ServiceBus\ServiceBusService;
use WindowsAzure\Services\ServiceBus\ServiceBusSettings;

class BrokerPropertiesMapperTest extends ServiceBusRestProxyTestBase {
    public function testJsonStringMapsToBrokerPropertiesObject() {
        // Arrange 
        $mapper = new BrokerPropertiesMapper();

        // Act
        $properties = $mapper->fromString('{\'DeliveryCount\':5,\'MessageId\':\'something\'}');

        // Assert
        $this->assertNotNull($properties, '$properties');
        $this->assertEquals(new Integer(5), $properties->getDeliveryCount(), '$properties->getDeliveryCount()');
        $this->assertEquals('something', $properties->getMessageId(), '$properties->getMessageId()');
    }

    public function testNonDefaultPropertiesMapToJsonString() {
        // Arrange 
        $mapper = new BrokerPropertiesMapper();

        // Act
        $properties = new BrokerProperties();
        $properties->setMessageId('foo');
        $properties->setDeliveryCount(7);
        $json = $mapper->toString($properties);

        // Assert
        $this->assertNotNull($json, '$json');
        $this->assertEquals('{\'DeliveryCount\':7,\'MessageId\':\'foo\'}', $json, '$json');
    }

    public function testDeserializingAllPossibleValues() {
        // Arrange 
        $mapper = new BrokerPropertiesMapper();

        $schedTimeUtc = \DateTime("Sun, 06 Nov 1994 08:49:37 GMT");
        $schedTimeUtc->setTimezone(new \DateTimeZone('UTC'));

        $lockedUntilUtc = \DateTime("Fri, 14 Oct 2011 12:34:56 GMT");
        $lockedUntilUtc->setTimezone(new \DateTimeZone('UTC'));

        // Act
        $properties = $mapper->fromString(
            '{' . 
            '\'CorrelationId\': \'corid\',' . 
            '\'SessionId\': \'sesid\',' . 
            '\'DeliveryCount\': 5,' . 
            '\'LockedUntilUtc\': \' Fri, 14 Oct 2011 12:34:56 GMT\',' . 
            '\'LockToken\': \'loctok\',' . 
            '\'MessageId\': \'mesid\',' . 
            '\'Label\': \'lab\',' . 
            '\'ReplyTo\': \'repto\',' . 
            '\'SequenceNumber\': 7,' . 
            '\'TimeToLive\': 8.123,' . 
            '\'To\': \'to\',' . 
            '\'ScheduledEnqueueTimeUtc\': \' Sun, 06 Nov 1994 08:49:37 GMT\',' . 
            '\'ReplyToSessionId\': \'reptosesid\',' . 
            '\'MessageLocation\': \'mesloc\',' . 
            '\'LockLocation\': \'locloc\'' . '}');

        // Assert
        $this->assertNotNull($properties, '$properties');

        $lockedUntilDelta = $properties->getLockedUntilUtc()->getTime() - $lockedUntilUtc->getTime();
        $schedTimeDelta = $properties->getScheduledEnqueueTimeUtc()->getTime() - $schedTimeUtc->getTime();

        $this->assertEquals('corid', $properties->getCorrelationId(), '$properties->getCorrelationId()');
        $this->assertEquals('sesid', $properties->getSessionId(), '$properties->getSessionId()');
        $this->assertEquals(5, (int) $properties->getDeliveryCount(), '(int) $properties->getDeliveryCount()');
        $this->assertTrue(abs($lockedUntilDelta) < 2000, 'abs($lockedUntilDelta) < 2000');
        $this->assertEquals('loctok', $properties->getLockToken(), '$properties->getLockToken()');
        $this->assertEquals('mesid', $properties->getMessageId(), '$properties->getMessageId()');
        $this->assertEquals('lab', $properties->getLabel(), '$properties->getLabel()');
        $this->assertEquals('repto', $properties->getReplyTo(), '$properties->getReplyTo()');
        $this->assertEquals(7, $properties->getSequenceNumber(), '$properties->getSequenceNumber()');
        $this->assertEquals(8.123, $properties->getTimeToLive(), .001);
        $this->assertEquals('to', $properties->getTo(), '$properties->getTo()');
        $this->assertTrue(abs($schedTimeDelta) < 2000, 'abs($schedTimeDelta) < 2000');
        $this->assertEquals('reptosesid', $properties->getReplyToSessionId(), '$properties->getReplyToSessionId()');
        $this->assertEquals('mesloc', $properties->getMessageLocation(), '$properties->getMessageLocation()');
        $this->assertEquals('locloc', $properties->getLockLocation(), '$properties->getLockLocation()');
    }

    public function testMissingDatesDeserializeAsNull() {
        // Arrange 
        $mapper = new BrokerPropertiesMapper();

        // Act
        $properties = $mapper->fromString('{}');

        // Assert
        $this->assertNull($properties->getLockedUntilUtc(), '$properties->getLockedUntilUtc()');
        $this->assertNull($properties->getScheduledEnqueueTimeUtc(), '$properties->getScheduledEnqueueTimeUtc()');
    }
}
?>
