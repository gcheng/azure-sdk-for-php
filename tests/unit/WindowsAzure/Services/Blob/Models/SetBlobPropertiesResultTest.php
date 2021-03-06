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
 * @package   PEAR2\Tests\Unit\WindowsAzure\Services\Blob\Models
 * @author    Abdelrahman Elogeel <Abdelrahman.Elogeel@microsoft.com>
 * @copyright 2012 Microsoft Corporation
 * @license   http://www.apache.org/licenses/LICENSE-2.0  Apache License 2.0
 * @link      http://pear.php.net/package/azure-sdk-for-php
 */
namespace PEAR2\Tests\Unit\WindowsAzure\Services\Blob\Models;
use PEAR2\WindowsAzure\Services\Blob\Models\SetBlobPropertiesResult;
use PEAR2\WindowsAzure\Core\WindowsAzureUtilities;

/**
 * Unit tests for class SetBlobPropertiesResult
 *
 * @category  Microsoft
 * @package   PEAR2\Tests\Unit\WindowsAzure\Services\Blob\Models
 * @author    Abdelrahman Elogeel <Abdelrahman.Elogeel@microsoft.com>
 * @copyright 2012 Microsoft Corporation
 * @license   http://www.apache.org/licenses/LICENSE-2.0  Apache License 2.0
 * @version   Release: @package_version@
 * @link      http://pear.php.net/package/azure-sdk-for-php
 */
class SetBlobPropertiesResultTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @covers PEAR2\WindowsAzure\Services\Blob\Models\SetBlobPropertiesResult::setLastModified
     * @covers PEAR2\WindowsAzure\Services\Blob\Models\SetBlobPropertiesResult::getLastModified
     */
    public function testSetLastModified()
    {
        // Setup
        $expected = WindowsAzureUtilities::rfc1123ToDateTime('Sun, 25 Sep 2011 19:42:18 GMT');
        $prooperties = new SetBlobPropertiesResult();
        $prooperties->setLastModified($expected);
        
        // Test
        $prooperties->setLastModified($expected);
        
        // Assert
        $this->assertEquals($expected, $prooperties->getLastModified());
    }
    
    /**
     * @covers PEAR2\WindowsAzure\Services\Blob\Models\SetBlobPropertiesResult::setEtag
     * @covers PEAR2\WindowsAzure\Services\Blob\Models\SetBlobPropertiesResult::getEtag
     */
    public function testSetEtag()
    {
        // Setup
        $expected = '0x8CAFB82EFF70C46';
        $prooperties = new SetBlobPropertiesResult();
        $prooperties->setEtag($expected);
        
        // Test
        $prooperties->setEtag($expected);
        
        // Assert
        $this->assertEquals($expected, $prooperties->getEtag());
    }
    
    /**
     * @covers PEAR2\WindowsAzure\Services\Blob\Models\SetBlobPropertiesResult::setSequenceNumber
     * @covers PEAR2\WindowsAzure\Services\Blob\Models\SetBlobPropertiesResult::getSequenceNumber
     */
    public function testSetSequenceNumber()
    {
        // Setup
        $expected = 123;
        $prooperties = new SetBlobPropertiesResult();
        $prooperties->setSequenceNumber($expected);
        
        // Test
        $prooperties->setSequenceNumber($expected);
        
        // Assert
        $this->assertEquals($expected, $prooperties->getSequenceNumber());
    }
}

?>
