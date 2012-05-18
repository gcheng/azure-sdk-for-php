<?php

/**
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
 * PHP version 5
 *
 * @category  Microsoft
 * @package   WindowsAzure\Services\Queue\Models
 * @author    Azure PHP SDK <azurephpsdk@microsoft.com>
 * @copyright 2012 Microsoft Corporation
 * @license   http://www.apache.org/licenses/LICENSE-2.0  Apache License 2.0
 * @link      http://pear.php.net/package/azure-sdk-for-php
 */
 
namespace WindowsAzure\Services\ServiceBus\Models;
use WindowsAzure\Resources;
use WindowsAzure\Utilities;
use WindowsAzure\Services\ServiceBus\Models\BrokerProperties;

/**
 * An active WRAP access Token.
 *
 * @category  Microsoft
 * @package   WindowsAzure\Services\ServiceBus\Models
 * @author    Azure PHP SDK <azurephpsdk@microsoft.com>
 * @copyright 2012 Microsoft Corporation
 */
class BrokeredMessage
{
    /**
     * The properties of the broker.
     * 
     * @var BrokerProperties
     */
    private $_brokerProperties;

    /**
     * The body of the brokered message.
     * 
     * @var string
     */
    private $_body;

    /**
     * The content type of the brokered message.
     * 
     * @var string
     */
    private $_contentType;

    /**
     * The date of the brokered message.
     * 
     * @var \DateTime 
     */
    private $_date;

    /**
     * The custom properties.
     * 
     * @var array
     */
    private $_customProperties; 

    public function __construct($brokerProperties)
    {
        $this->_brokerProperties = $brokerProperties;
        $this->_customProperties = array();
    }
    /** 
     * Gets the broker properties.
     *
     * @return BrokerProperties
     */
    public function getBrokerProperties() {
        return _brokerProperties;
    }

    /** 
     * Sets the broker properties.
     * 
     * @param BrokerProperties $brokerProperties The properties of broker.
     */
    public function setBrokerProperties($brokerProperties)
    {
        $this->_brokerProperties = $brokerProperties;
    }
   
    /**
     * Gets the body of the brokered message. 
     * 
     * @return string
     */
    public function getBody() {
        return $this->_body;
    } 
    
    /**
     * Sets the body of the brokered message. 
     * 
     * @param string $body The body of the brokered message.
     */
    public function setBody($body) {
        $this->_body = $body;
    }

    /**
     * Gets the content type of the brokered message. 
     * 
     * @return string
     */
    public function getContentType() {
        return $this->_contentType;
    } 

    /**
     * Sets the content type of the brokered message. 
     * 
     * @param string $contentType The content type of 
     * the brokered message. 
     */ 
    public function setContentType($contentType) {
        $this->_contentType = $contentType;
    } 

    public function getDate() {
        return $this->_date;
    }
    
    public function setDate($date) {
        $this->_date = $date;
    }
    
    /**
     * Gets the value of a custom property. 
     *
     * @param string $propertyName The name of the property. 
     */
    public function getProperty($propertyName) {
        return $this->_customProperties[$propertyName];
    } 

    /**
     * Sets the value of a custom property. 
     * 
     * @param string $propertyName  The name of the property.
     * @param string $propertyValue The value of the property.
     */
    public function setProperty($propertyName, $propertyValue) {
        $this->customProperties[$propertyName] = $propertyValue;
    }

    /**
     * Gets the custom properties. 
     *
     * @return array 
     */
    public function getProperties() {
        return $this->_customProperties;
    }

    public function getDeliveryCount() {
        return $this->_brokerProperties->getDeliveryCount();
    }

    public function getMessageId() {
        return $this->_brokerProperties->getMessageId();
    }
    
    public function setMesageId($messageId) {
        $this->_brokerProperties->setMesageId($messageId);
    }
    
    public function getSequenceNumber() {
        $this->_brokerProperties->getSequenceNumber();
    }

    public function getTimeToLive() {
        $this->_brokerProperties->getTimeToLive();
    }

    public function setTimeToLive() {
        $this->_brokerProperties->setTimeToLive($timeToLive);
    }

    public function getLockToken() {
        return $this->_brokerProperties->getLockToken();
    }

    public function getLockUntiUtc() {
        return $this->_brokerProperties->getLockedUntilUtc();
    }

    public function getCorrelationId() {
        return $this->_brokerProperties->getCorrelationId();
    }
    
    public function setCorrelationId($correlationId) {
        $this->_brokerProperties->setCorrelationId($correlationId);
    }

    public function getSessionId() {
        $this->_brokerProperties->getSessionId();
    }
    
    public function setSessionId($sessionId) {
        $this->_brokerProperities->setSessionId($sessionId);
    }

    public function getLabel() {
        return $this->_brokerProperties->getLabel();
    }

    public function setLabel($label) {
        $this->_brokerProperties->setLabel($label);
    }

    public function getReplyTo() {
        return $this->_brokerProperties->getReplyTo();
    }

    public function setReplyTo($replyTo) {
        $this->_brokerProperties->setReplytTo($replyTo);
    }

    public function getTo() {
        return $this->_brokerProperties->getTo();
    } 

    public function setTo($to) {
        $this->_borkerProeprties->setTo($to);
    }

    public function getScheduledEnqueueTimeUtc() {
        return $this->_brokerProperties->getScheduledEnqueueTimeUtc();
    }
    
    public function setScheduledEnqueueTimeUtc($scheduledEnqueueTimeUtc) {
        $this->_brokerProperties->setScheduledEnqueueTimeUtc($scheduledEnqueueTimeUtc);
    }

    public function getReplyToSessionId() {
        return $this->_brokerProperties->getReplyToSessionId();
    }

    public function setReplyToSessionId($replyToSessionId) {
        $this->_brokerProperties->setReplyToSessionId($replyToSessionId);
    }
    
    public function getMessageLocation() {
        return $this->_brokerProperties->getMessageLocation();
    }

    public function getLockLocation() {
        return $this->_brokerProperties->getLockLocation();
    }
    
}

?>