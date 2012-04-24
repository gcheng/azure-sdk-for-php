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
 * @author    Albert Cheng <gongchen at the largest software company> 
 * @copyright 2012 Microsoft Corporation
 * @license   http://www.apache.org/licenses/LICENSE-2.0  Apache License 2.0
 * @link      http://pear.php.net/package/azure-sdk-for-php
 */
namespace PEAR2\Tests\Unit\WindowsAzure\Services\Blob\Models;
use PEAR2\Tests\Framework\TestResources;
use PEAR2\WindowsAzure\Core\WindowsAzureUtilities;
use PEAR2\WindowsAzure\Services\Blob\Models\CreateBlobSnapshotOptions;

/**
 * Unit tests for class CreateBlobSnapshotOptions
 *
 * @category  Microsoft
 * @package   PEAR2\Tests\Unit\WindowsAzure\Services\Blob\Models
 * @author    Albert Cheng <gongchen at the largest software company>
 * @copyright 2012 Microsoft Corporation
 * @license   http://www.apache.org/licenses/LICENSE-2.0  Apache License 2.0
 * @version   Release: @package_version@
 * @link      http://pear.php.net/package/azure-sdk-for-php
 */
class CreateBlobSnapshotOptionsTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @covers PEAR2\WindowsAzure\Services\Blob\Models\CreateBlobSnapshotOptions::setDate
     * @covers PEAR2\WindowsAzure\Services\Blob\Models\CreateBlobSnapshotOptions::getDate
     */
    public function testSetDate()
    {
        $createBlobSnapshotOptions = new CreateBlobSnapshotOptions();
        $expected = new \DateTime("2011-8-8");
        
        $createBlobSnapshotOptions->setDate($expected);
        
        $this->assertEquals(
            $expected,
            $createBlobSnapshotOptions->getDate()
            );
    }
    
    /**
     * @covers PEAR2\WindowsAzure\Services\Blob\Models\CreateBlobSnapshotOptions::setVersion
     * @covers PEAR2\WindowsAzure\Services\Blob\Models\CreateBlobSnapshotOptions::getVersion
     */
    public function testSetVersion()
    {
        $createBlobSnapshotOptions = new CreateBlobSnapshotOptions();
        $expected = "2008-8-8";
        
        $createBlobSnapshotOptions->setVersion($expected);
        
        $this->assertEquals(
            $expected,
            $createBlobSnapshotOptions->getVersion()
            );
             
    }
    
    /**
     * @covers PEAR2\WindowsAzure\Services\Blob\Models\CreateBlobSnapshotOptions::setMetadata
     * @covers PEAR2\WindowsAzure\Services\Blob\Models\CreateBlobSnapshotOptions::getMetadata
     */
    public function testSetMetadata()
    {
        $createBlobSnapshotOptions = new CreateBlobSnapshotOptions();
        $expected = array('key1' => 'value1', 'key2' => 'value2');
        $createBlobSnapshotOptions->setMetadata($expected);
        
        $this->assertEquals(
            $expected,
            $createBlobSnapshotOptions->getMetadata()
            );
    }
    
    /**
     * @covers PEAR2\WindowsAzure\Services\Blob\Models\CreateBlobSnapshotOptions::setIfModifiedSince
     * @covers PEAR2\WindowsAzure\Services\Blob\Models\CreateBlobSnapshotOptions::getIfModifiedSince
     */
    public function testSetIfModifiedSince()
    {
        $createBlobSnapshotOptions = new CreateBlobSnapshotOptions();
        $expected = new \DateTime("2008-8-8");
        $createBlobSnapshotOptions->setIfModifiedSince($expected);
        
        $this->assertEquals(
            $expected,
            $createBlobSnapshotOptions->getIfModifiedSince()
            );
    }
    
    /**
     * @covers PEAR2\WindowsAzure\Services\Blob\Models\CreateBlobSnapshotOptions::setIfUnmodifiedSince
     * @covers PEAR2\WindowsAzure\Services\Blob\Models\CreateBlobSnapshotOptions::getIfUnmodifiedSince
     */
    public function testSetIfUnmodifiedSince()
    {
        $createBlobSnapshotOptions = new CreateBlobSnapshotOptions();
        $expected = new \DateTime("2008-8-8");
        $createBlobSnapshotOptions->setIfUnmodifiedSince($expected);
        
        $this->assertEquals(
            $expected,
            $createBlobSnapshotOptions->getIfUnmodifiedSince()
            );
    }
    
    /**
     * @covers PEAR2\WindowsAzure\Services\Blob\Models\CreateBlobSnapshotOptions::setIfMatch
     * @covers PEAR2\WindowsAzure\Services\Blob\Models\CreateBlobSnapshotOptions::getIfMatch
     */
    public function testSetIfMatch()
    {
        $createBlobSnapshotOptions = new CreateBlobSnapshotOptions();
        $expected = "12345678";
        $createBlobSnapshotOptions->setIfMatch($expected);
        
        $this->assertEquals(
            $expected,
            $createBlobSnapshotOptions->getIfMatch()
            );
    }
    
    /**
     * @covers PEAR2\WindowsAzure\Services\Blob\Models\CreateBlobSnapshotOptions::setIfNoneMatch
     * @covers PEAR2\WindowsAzure\Services\Blob\Models\CreateBlobSnapshotOptions::getIfNoneMatch
     */
    public function testSetIfNoneMatch()
    {
        $createBlobSnapshotOptions = new CreateBlobSnapshotOptions();
        $expected = "12345678";
        $createBlobSnapshotOptions->setIfNoneMatch($expected);
        
        $this->assertEquals(
            $expected,
            $createBlobSnapshotOptions->getIfNoneMatch()
            );
    }
    
    /**
     * @covers PEAR2\WindowsAzure\Services\Blob\Models\CreateBlobSnapshotOptions::setLeaseId
     * @covers PEAR2\WindowsAzure\Services\Blob\Models\CreateBlobSnapshotOptions::getLeaseId
     */
    public function testSetLeaseId()
    {
        $createBlobSnapshotOptions = new CreateBlobSnapshotOptions();
        $expected = "123456789";
        $createBlobSnapshotOptions->setLeaseId($expected);
        
        $this->assertEquals(
            $expected,
            $createBlobSnapshotOptions->getLeaseId()
            );
        
    }
}
?>