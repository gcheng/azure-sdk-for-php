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
use PEAR2\WindowsAzure\Services\Blob\Models\ListContainersResult;
use PEAR2\Tests\Framework\TestResources;
use PEAR2\WindowsAzure\Core\WindowsAzureUtilities;

/**
 * Unit tests for class ListContainersResult
 *
 * @category  Microsoft
 * @package   PEAR2\Tests\Unit\WindowsAzure\Services\Blob\Models
 * @author    Abdelrahman Elogeel <Abdelrahman.Elogeel@microsoft.com>
 * @copyright 2012 Microsoft Corporation
 * @license   http://www.apache.org/licenses/LICENSE-2.0  Apache License 2.0
 * @version   Release: @package_version@
 * @link      http://pear.php.net/package/azure-sdk-for-php
 */
class ListContainersResultTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @covers PEAR2\WindowsAzure\Services\Blob\Models\ListContainersResult::create 
     */
    public function testCreateWithEmpty()
    {
        // Setup
        $sample = TestResources::listContainersEmpty();
        
        // Test
        $actual = ListContainersResult::create($sample);
        
        // Assert
        $this->assertCount(0, $actual->getContainers());
        $this->assertTrue(empty($sample['NextMarker']));
    }
    
    /**
     * @covers PEAR2\WindowsAzure\Services\Blob\Models\ListContainersResult::create 
     */
    public function testCreateWithOneEntry()
    {
        // Setup
        $sample = TestResources::listContainersOneEntry();
        
        // Test
        $actual = ListContainersResult::create($sample);
        
        // Assert
        $containers = $actual->getContainers();
        $this->assertCount(1, $containers);
        $this->assertEquals($sample['Containers']['Container']['Name'], $containers[0]->getName());
        $this->assertEquals($sample['Containers']['Container']['Url'], $containers[0]->getUrl());
        $this->assertEquals(
         WindowsAzureUtilities::rfc1123ToDateTime($sample['Containers']['Container']['Properties']['Last-Modified']),
        $containers[0]->getProperties()->getLastModified());
        $this->assertEquals(
            $sample['Containers']['Container']['Properties']['Etag'],
            $containers[0]->getProperties()->getEtag());
        $this->assertEquals($sample['Marker'], $actual->getMarker());
        $this->assertEquals($sample['MaxResults'], $actual->getMaxResults());
        $this->assertEquals($sample['NextMarker'], $actual->getNextMarker());
    }
    
    /**
     * @covers PEAR2\WindowsAzure\Services\Blob\Models\ListContainersResult::create 
     */
    public function testCreateWithMultipleEntries()
    {
        // Setup
        $sample = TestResources::listContainersMultipleEntries();
        
        // Test
        $actual = ListContainersResult::create($sample);
        
        // Assert
        $containers = $actual->getContainers();
        $this->assertCount(2, $containers);
        $this->assertEquals($sample['Containers']['Container'][0]['Name'], $containers[0]->getName());
        $this->assertEquals($sample['Containers']['Container'][0]['Url'], $containers[0]->getUrl());
        $this->assertEquals(
            WindowsAzureUtilities::rfc1123ToDateTime($sample['Containers']['Container'][0]['Properties']['Last-Modified']), 
            $containers[0]->getProperties()->getLastModified());
        $this->assertEquals(
            $sample['Containers']['Container'][0]['Properties']['Etag'],
            $containers[0]->getProperties()->getEtag());
        $this->assertEquals($sample['Containers']['Container'][1]['Name'], $containers[1]->getName());
        $this->assertEquals($sample['Containers']['Container'][1]['Url'], $containers[1]->getUrl());
        $this->assertEquals(
            WindowsAzureUtilities::rfc1123ToDateTime($sample['Containers']['Container'][1]['Properties']['Last-Modified']), 
            $containers[1]->getProperties()->getLastModified());
        $this->assertEquals(
            $sample['Containers']['Container'][1]['Properties']['Etag'],
            $containers[1]->getProperties()->getEtag());
        $this->assertEquals($sample['MaxResults'], $actual->getMaxResults());
        $this->assertEquals($sample['NextMarker'], $actual->getNextMarker());
        
        return $actual;
    }
    
    /**
     * @covers PEAR2\WindowsAzure\Services\Blob\Models\ListContainersResult::getContainers
     * @depends testCreateWithMultipleEntries
     */
    public function testGetContainers($result)
    {
        // Test
        $actual = $result->getContainers();
        
        // Assert
        $this->assertCount(2, $actual);
    }
    
    /**
     * @covers PEAR2\WindowsAzure\Services\Blob\Models\ListContainersResult::setContainers
     * @depends testCreateWithMultipleEntries
     */
    public function testSetContainers($result)
    {
        // Setup
        $sample = new ListContainersResult();
        $expected = $result->getContainers();
        
        // Test
        $sample->setContainers($expected);
        
        // Assert
        $this->assertEquals($expected, $sample->getContainers());
        $expected[0]->setName('test');
        $this->assertNotEquals($expected, $sample->getContainers());
    }
    
    /**
     * @covers PEAR2\WindowsAzure\Services\Blob\Models\ListContainersResult::setPrefix
     */
    public function testSetPrefix()
    {
        // Setup
        $options = new ListContainersResult();
        $expected = 'myprefix';
        
        // Test
        $options->setPrefix($expected);
        
        // Assert
        $this->assertEquals($expected, $options->getPrefix());
    }
    
    /**
     * @covers PEAR2\WindowsAzure\Services\Blob\Models\ListContainersResult::getPrefix
     */
    public function testGetPrefix()
    {
        // Setup
        $options = new ListContainersResult();
        $expected = 'myprefix';
        $options->setPrefix($expected);
        
        // Test
        $actual = $options->getPrefix();
        
        // Assert
        $this->assertEquals($expected, $actual);
    }
    
    /**
     * @covers PEAR2\WindowsAzure\Services\Blob\Models\ListContainersResult::setNextMarker
     */
    public function testSetNextMarker()
    {
        // Setup
        $options = new ListContainersResult();
        $expected = 'mymarker';
        
        // Test
        $options->setNextMarker($expected);
        
        // Assert
        $this->assertEquals($expected, $options->getNextMarker());
    }
    
    /**
     * @covers PEAR2\WindowsAzure\Services\Blob\Models\ListContainersResult::getNextMarker
     */
    public function testGetNextMarker()
    {
        // Setup
        $options = new ListContainersResult();
        $expected = 'mymarker';
        $options->setNextMarker($expected);
        
        // Test
        $actual = $options->getNextMarker();
        
        // Assert
        $this->assertEquals($expected, $actual);
    }
    
    /**
     * @covers PEAR2\WindowsAzure\Services\Blob\Models\ListContainersResult::setMarker
     */
    public function testSetMarker()
    {
        // Setup
        $options = new ListContainersResult();
        $expected = 'mymarker';
        
        // Test
        $options->setMarker($expected);
        
        // Assert
        $this->assertEquals($expected, $options->getMarker());
    }
    
    /**
     * @covers PEAR2\WindowsAzure\Services\Blob\Models\ListContainersResult::getMarker
     */
    public function testGetMarker()
    {
        // Setup
        $options = new ListContainersResult();
        $expected = 'mymarker';
        $options->setMarker($expected);
        
        // Test
        $actual = $options->getMarker();
        
        // Assert
        $this->assertEquals($expected, $actual);
    }
    
    /**
     * @covers PEAR2\WindowsAzure\Services\Blob\Models\ListContainersResult::setMaxResults
     */
    public function testSetMaxResults()
    {
        // Setup
        $options = new ListContainersResult();
        $expected = '3';
        
        // Test
        $options->setMaxResults($expected);
        
        // Assert
        $this->assertEquals($expected, $options->getMaxResults());
    }
    
    /**
     * @covers PEAR2\WindowsAzure\Services\Blob\Models\ListContainersResult::getMaxResults
     */
    public function testGetMaxResults()
    {
        // Setup
        $options = new ListContainersResult();
        $expected = '3';
        $options->setMaxResults($expected);
        
        // Test
        $actual = $options->getMaxResults();
        
        // Assert
        $this->assertEquals($expected, $actual);
    }
}

?>
