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
 * @package   WindowsAzure\Services\Queue
 * @author    Azure PHP SDK <azurephpsdk@microsoft.com>
 * @copyright 2012 Microsoft Corporation
 * @license   http://www.apache.org/licenses/LICENSE-2.0  Apache License 2.0
 * @link      http://pear.php.net/package/azure-sdk-for-php
 */

namespace WindowsAzure\Services\ServiceBus\Models;

use WindowsAzure\Core\Atom\Feed;
use WindowsAzure\Core\Atom\Content;

/**
 * This class constructs HTTP requests and receive HTTP responses for service bus.
 *
 * @category  Microsoft
 * @package   WindowsAzure\Services\ServiceBus
 * @author    Azure PHP SDK <azurephpsdk@microsoft.com>
 * @copyright 2012 Microsoft Corporation
 * @license   http://www.apache.org/licenses/LICENSE-2.0  Apache License 2.0
 * @version   Release: @package_version@
 * @link      http://pear.php.net/package/azure-sdk-for-php
 */
 
class GetSubscriptionResult
{
    /**
     * The information of a subscription. 
     *
     * @var SubscriptionInfo
     */
    private $_subscriptionInfo;

    /**
     * Creates a subscription information instance with specified response. 
     * 
     * @param string $response The response from the server. 
     */ 
    public static function create($response)
    {
        $getSubscriptionResult = new GetSubscriptionResult();
        $feed = Feed::create($response);
        $entry = $feed->getEntry();
        $content = $entry->getContent($content);
        $subscriptionInfo = XmlSerializer::objectDeserialize($content->getText());
        $getSubscriptionResult->setSubscriptionInfo($subscriptionInfo);
        return $getSubscriptionResult;
    }

    /** 
     * Gets the subscription information.
     *
     * @return SubscriptionInfo
     */ 
    public function getSubscriptionInfo()
    {
        return $this->_subscriptionInfo;
    }

    /**
     * Sets the subscription information.
     * 
     * @param SubscriptionInfo $subscriptionInfo The information of the subscription.
     */
    public function setSubscriptionInfo($subscriptionInfo)
    {
        $this->_subscriptionInfo = $subscriptionInfo;
    }
}