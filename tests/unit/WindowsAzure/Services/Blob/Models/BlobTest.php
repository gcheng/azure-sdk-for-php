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
use PEAR2\WindowsAzure\Services\Blob\Models\Blob;
use PEAR2\Tests\Framework\TestResources;
use PEAR2\WindowsAzure\Services\Blob\Models\BlobProperties;

/**
 * Unit tests for class Blob
 *
 * @category  Microsoft
 * @package   PEAR2\Tests\Unit\WindowsAzure\Services\Blob\Models
 * @author    Abdelrahman Elogeel <Abdelrahman.Elogeel@microsoft.com>
 * @copyright 2012 Microsoft Corporation
 * @license   http://www.apache.org/licenses/LICENSE-2.0  Apache License 2.0
 * @version   Release: @package_version@
 * @link      http://pear.php.net/package/azure-sdk-for-php
 */
class BlobTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @covers PEAR2\WindowsAzure\Services\Blob\Models\Blob::setName
     */
    public function testSetName()
    {
        // Setup
        $blob = new Blob();
        $expected = TestResources::QUEUE1_NAME;
        
        // Test
        $blob->setName($expected);
        
        // Assert
        $this->assertEquals($expected, $blob->getName());
    }
    
    /**
     * @covers PEAR2\WindowsAzure\Services\Blob\Models\Blob::getName
     */
    public function testGetName()
    {
        // Setup
        $blob = new Blob();
        $expected = TestResources::QUEUE1_NAME;
        $blob->setName($expected);
        
        // Test
        $actual = $blob->getName();
        
        // Assert
        $this->assertEquals($expected, $actual);
    }
    
    /**
     * @covers PEAR2\WindowsAzure\Services\Blob\Models\Blob::setUrl
     */
    public function testSetUrl()
    {
        // Setup
        $blob = new Blob();
        $expected = TestResources::QUEUE1_NAME;
        
        // Test
        $blob->setUrl($expected);
        
        // Assert
        $this->assertEquals($expected, $blob->getUrl());
    }
    
    /**
     * @covers PEAR2\WindowsAzure\Services\Blob\Models\Blob::getUrl
     */
    public function testGetUrl()
    {
        // Setup
        $blob = new Blob();
        $expected = TestResources::QUEUE_URI;
        $blob->setUrl($expected);
        
        // Test
        $actual = $blob->getUrl();
        
        // Assert
        $this->assertEquals($expected, $actual);
    }
    
    /**
     * @covers PEAR2\WindowsAzure\Services\Blob\Models\Blob::setSnapshot
     */
    public function testSetSnapshot()
    {
        // Setup
        $blob = new Blob();
        $expected = TestResources::QUEUE1_NAME;
        
        // Test
        $blob->setSnapshot($expected);
        
        // Assert
        $this->assertEquals($expected, $blob->getSnapshot());
    }
    
    /**
     * @covers PEAR2\WindowsAzure\Services\Blob\Models\Blob::getSnapshot
     */
    public function testGetSnapshot()
    {
        // Setup
        $blob = new Blob();
        $expected = TestResources::QUEUE_URI;
        $blob->setSnapshot($expected);
        
        // Test
        $actual = $blob->getSnapshot();
        
        // Assert
        $this->assertEquals($expected, $actual);
    }
    
    /**
     * @covers PEAR2\WindowsAzure\Services\Blob\Models\Blob::setMetadata
     */
    public function testSetMetadata()
    {
        // Setup
        $blob = new Blob();
        $expected = array('key1' => 'value1', 'key2' => 'value2');
        
        // Test
        $blob->setMetadata($expected);
        
        // Assert
        $this->assertEquals($expected, $blob->getMetadata());
    }
    
    /**
     * @covers PEAR2\WindowsAzure\Services\Blob\Models\Blob::getMetadata
     */
    public function testGetMetadata()
    {
        // Setup
        $blob = new Blob();
        $expected = array('key1' => 'value1', 'key2' => 'value2');
        $blob->setMetadata($expected);
        
        // Test
        $actual = $blob->getMetadata();
        
        // Assert
        $this->assertEquals($expected, $actual);
    }
    
    /**
     * @covers PEAR2\WindowsAzure\Services\Blob\Models\Blob::setProperties
     */
    public function testSetProperties()
    {
        // Setup
        $blob = new Blob();
        $expected = new BlobProperties();
        
        // Test
        $blob->setProperties($expected);
        
        // Assert
        $this->assertEquals($expected, $blob->getProperties());
    }
    
    /**
     * @covers PEAR2\WindowsAzure\Services\Blob\Models\Blob::getProperties
     */
    public function testGetProperties()
    {
        // Setup
        $blob = new Blob();
        $expected = new BlobProperties();
        $blob->setProperties($expected);
        
        // Test
        $actual = $blob->getProperties();
        
        // Assert
        $this->assertEquals($expected, $actual);
    }
}

?>
