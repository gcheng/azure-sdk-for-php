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
 * @package   PEAR2\WindowsAzure\Services\Queue\Models
 * @author    Abdelrahman Elogeel <Abdelrahman.Elogeel@microsoft.com>
 * @copyright 2012 Microsoft Corporation
 * @license   http://www.apache.org/licenses/LICENSE-2.0  Apache License 2.0
 * @link      http://pear.php.net/package/azure-sdk-for-php
 */
 
namespace PEAR2\WindowsAzure\Services\Queue\Models;
use PEAR2\WindowsAzure\Resources;
use PEAR2\WindowsAzure\Services\Queue\Models\Queue;
use PEAR2\WindowsAzure\Utilities\Utilities;

/**
 * Container to hold list queue response object.
 *
 * @category  Microsoft
 * @package   PEAR2\WindowsAzure\Services\Queue\Models
 * @author    Abdelrahman Elogeel <Abdelrahman.Elogeel@microsoft.com>
 * @copyright 2012 Microsoft Corporation
 * @license   http://www.apache.org/licenses/LICENSE-2.0  Apache License 2.0
 * @version   Release: @package_version@
 * @link      http://pear.php.net/package/azure-sdk-for-php
 */
class ListQueueResult
{
    private $_queues;
    private $_prefix;
    private $_marker;
    private $_nextMarker;
    private $_maxResults;

    /**
     * Creates ListQueueResult object from parsed XML response.
     *
     * @param array $parsedResponse XML response parsed into array.
     * 
     * @return PEAR2\WindowsAzure\Services\Queue\Models\ListQueueResult.
     */
    public static function create($parsedResponse)
    {
        $result              = new ListQueueResult();
        $result->_prefix     = Utilities::tryGetValue(
            $parsedResponse, Resources::PREFIX
        );
        $result->_marker     = Utilities::tryGetValue(
            $parsedResponse, Resources::MARKER
        );
        $result->_nextMarker = Utilities::tryGetValue(
            $parsedResponse, Resources::NEXT_MARKER
        );
        $result->_queues     = array();
        $rawQueues           = array();
        
        if (is_array($parsedResponse['Queues'])) {
            $rawQueues = Utilities::getArray($parsedResponse['Queues']['Queue']);
        }
        
        foreach ($rawQueues as $value) {
            $queue = new Queue($value['Name'], $value['Url']);
            $queue->setMetadata(Utilities::tryGetValue($value, Resources::METADATA));
            $result->_queues[] = $queue;
        }
        
        return $result;
    }

    /**
     * Gets queues.
     *
     * @return array.
     */
    public function getQueues()
    {
        return $this->_queues;
    }

    /**
     * Gets perfix.
     *
     * @return string.
     */
    public function getPrefix()
    {
        $this->_prefix;
    }

    /**
     * Sets perfix.
     *
     * @param string $prefix value.
     * 
     * @return none.
     */
    public function setPrefix($prefix)
    {
        $this->_prefix = $prefix;
    }

    /**
     * Gets marker.
     * 
     * @return string.
     */
    public function getMarker()
    {
        return $this->_marker;
    }

    /**
     * Sets marker.
     *
     * @param string $marker value.
     * 
     * @return none.
     */
    public function setMarker($marker)
    {
        $this->_marker = $marker;
    }

    /**
     * Gets max results.
     * 
     * @return string.
     */
    public function getMaxResults()
    {
        return $this->_maxResults;
    }

    /**
     * Sets max results.
     *
     * @param string $maxResults value.
     * 
     * @return none.
     */
    public function setMaxResults($maxResults)
    {
        $this->_maxResults = $maxResults;
    }

    /**
     * Gets next marker.
     * 
     * @return string.
     */
    public function getNextMarker()
    {
        return $this->_nextMarker;
    }

    /**
     * Sets next marker.
     *
     * @param string $nextMarker value.
     * 
     * @return none.
     */
    public function setNextMarker($nextMarker)
    {
        $this->_nextMarker = $nextMarker;
    }
}

?>