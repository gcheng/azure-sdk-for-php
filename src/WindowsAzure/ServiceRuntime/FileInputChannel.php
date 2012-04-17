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
 * @package   PEAR2\WindowsAzure\ServiceRuntime
 * @author    Abdelrahman Elogeel <Abdelrahman.Elogeel@microsoft.com>
 * @copyright 2012 Microsoft Corporation
 * @license   http://www.apache.org/licenses/LICENSE-2.0  Apache License 2.0
 * @link      http://pear.php.net/package/azure-sdk-for-php
 */

namespace PEAR2\WindowsAzure\ServiceRuntime;

/**
 * The file input channel.
 *
 * @category  Microsoft
 * @package   PEAR2\WindowsAzure\ServiceRuntime
 * @author    Abdelrahman Elogeel <Abdelrahman.Elogeel@microsoft.com>
 * @copyright 2012 Microsoft Corporation
 * @license   http://www.apache.org/licenses/LICENSE-2.0  Apache License 2.0
 * @version   Release: @package_version@
 * @link      http://pear.php.net/package/azure-sdk-for-php
 */
class FileInputChannel implements IInputChannel
{
    /**
     * @var Resource
     */
    private $_inputStream;
    
    /**
     * Gets the input stream.
     * 
     * @param string $name The input stream path.
     * 
     * @return none
     */
    public function getInputStream($name)
    {
        if (file_exists($name)) {
            $this->_inputStream = fopen($name, 'r');
            return $this->_inputStream;
        } else {
            throw new ChannelNotAvailableException();
        }
    }
    
    /**
     * Closes the input stream.
     * 
     * @return none
     */
    public function closeInputStream() 
    {
        if (!is_null($this->_inputStream)) {
            fclose($this->_inputStream);
            $this->_inputStream = null;
        }
    }
}

?>