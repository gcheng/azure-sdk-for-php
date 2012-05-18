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
use WindowsAzure\Services\ServiceBus\Models\TopicDescription;
use WindowsAzure\Utilities;

/**
 * The information of a topic.
 *
 * @category  Microsoft
 * @package   WindowsAzure\Services\ServiceBus\Models
 * @author    Azure PHP SDK <azurephpsdk@microsoft.com>
 * @copyright 2012 Microsoft Corporation
 * @license   http://www.apache.org/licenses/LICENSE-2.0  Apache License 2.0
 * @version   Release: @package_version@
 * @link      http://pear.php.net/package/azure-sdk-for-php
 */
class TopicInfo
{
    /** 
     * The WRAP access token result. 
     * 
     * @var WrapAccessTokenResult
     */
    private $_name;
    private $_topicDescription;

    /**
     * Creates an TopicInfo with specified parameters.
     *
     * @param string           $name             The name of the topic.
     * @param TopicDescription $topicDescription The description of the topic.
     * 
     */
    public function __construct($name, $topicDescription = null)
    {
        $this->_name = $name;
        if (is_null($topicDescription))
        {
            $topicDescription = new TopicDescription();
        }

        $this->_topicDescription = $topicDescription;
    }

    /**
     * Gets the name of the topic.
     *
     * @return string.
     */
    public function getName()
    {
        return $this->_name;
    }

    /**
     * Sets the name of the topic information.
     * 
     * @param string $name The name of the topic. 
     */
    public function setName($name)
    {
        $this->_name = $name;
    }

    /**
     * Gets the descriptions of the topic. 
     * 
     * @return TopicDescription
     */
    public function getTopicDescription()
    {
        return $this->_topicDescription;
    }

    /** 
     * Sets the descriptions of the topic. 
     * 
     * @param TopicDescription $topicDescription The description of the topic. 
     */
    public function setTopicDescription($topicDescription)
    {
        $this->_topicDescription = $topicDescription;
    }
    
}
?>
