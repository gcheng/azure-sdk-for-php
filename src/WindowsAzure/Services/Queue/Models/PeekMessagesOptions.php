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

/**
 * Short description
 *
 * @category  Microsoft
 * @package   PEAR2\WindowsAzure\Services\Queue\Models
 * @author    Abdelrahman Elogeel <Abdelrahman.Elogeel@microsoft.com>
 * @copyright 2012 Microsoft Corporation
 * @license   http://www.apache.org/licenses/LICENSE-2.0  Apache License 2.0
 * @version   Release: @package_version@
 * @link      http://pear.php.net/package/azure-sdk-for-php
 */
class PeekMessagesOptions
{
    /**
     * A nonzero integer value that specifies the number of messages to peek from 
     * the queue, up to a maximum of 32. By default, a single message is peeked 
     * from the queue with this operation.
     * 
     * @var integer
     */
    private $_numberOfMessages;
    
    /**
     * Gets numberOfMessages field.
     * 
     * @return integer
     */
    public function getNumberOfMessages()
    {
        return $this->_numberOfMessages;
    }
    
    /**
     * Sets numberOfMessages field.
     * 
     * @param integer $numberOfMessages value to use.
     * 
     * @return none
     */
    public function setNumberOfMessages($numberOfMessages)
    {
        $this->_numberOfMessages = $numberOfMessages;
    }
}

?>
