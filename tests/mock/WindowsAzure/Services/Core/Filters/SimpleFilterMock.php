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
 * @package   PEAR2\Tests\Mock\WindowsAzure\Services\Core\Filters
 * @author    Abdelrahman Elogeel <Abdelrahman.Elogeel@microsoft.com>
 * @copyright 2012 Microsoft Corporation
 * @license   http://www.apache.org/licenses/LICENSE-2.0  Apache License 2.0
 * @link      http://pear.php.net/package/azure-sdk-for-php
 */
 
namespace PEAR2\Tests\Mock\WindowsAzure\Services\Core\Filters;
use PEAR2\Tests\Framework\TestResources;

/**
 * Alters request headers and response to mock real filter
 *
 * @category  Microsoft
 * @package   PEAR2\Tests\Mock\WindowsAzure\Services\Core\Filters
 * @author    Abdelrahman Elogeel <Abdelrahman.Elogeel@microsoft.com>
 * @copyright 2012 Microsoft Corporation
 * @license   http://www.apache.org/licenses/LICENSE-2.0  Apache License 2.0
 * @version   Release: @package_version@
 * @link      http://pear.php.net/package/azure-sdk-for-php
 */
class SimpleFilterMock implements \PEAR2\WindowsAzure\Core\IServiceFilter
{
    private $_headerName;
    private $_data;
    
    public function __construct($headerName, $data)
    {
        $this->_data       = $data;
        $this->_headerName = $headerName;
    }
    
    public function handleRequest($request)
    {
        $request->setHeader($this->_headerName, $this->_data);
        return $request;
    }
    
    public function handleResponse($request, $response)
    {
        $response->appendBody($this->_data);
        return $response;
    }
}

?>
