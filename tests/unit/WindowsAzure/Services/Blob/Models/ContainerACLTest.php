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
use PEAR2\WindowsAzure\Services\Blob\Models\ContainerAcl;
use PEAR2\Tests\Framework\TestResources;
use PEAR2\WindowsAzure\Resources;
use PEAR2\WindowsAzure\Core\WindowsAzureUtilities;
use PEAR2\WindowsAzure\Utilities;

/**
 * Unit tests for class ContainerAcl
 *
 * @category  Microsoft
 * @package   PEAR2\Tests\Unit\WindowsAzure\Services\Blob\Models
 * @author    Abdelrahman Elogeel <Abdelrahman.Elogeel@microsoft.com>
 * @copyright 2012 Microsoft Corporation
 * @license   http://www.apache.org/licenses/LICENSE-2.0  Apache License 2.0
 * @version   Release: @package_version@
 * @link      http://pear.php.net/package/azure-sdk-for-php
 */
class ContainerAclTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @covers PEAR2\WindowsAzure\Services\Blob\Models\ContainerAcl::create
     * @covers PEAR2\WindowsAzure\Services\Blob\Models\ContainerAcl::getEtag
     * @covers PEAR2\WindowsAzure\Services\Blob\Models\ContainerAcl::getLastModified
     * @covers PEAR2\WindowsAzure\Services\Blob\Models\ContainerAcl::getPublicAccess
     * @covers PEAR2\WindowsAzure\Services\Blob\Models\ContainerAcl::getSignedIdentifiers
     * @covers PEAR2\WindowsAzure\Services\Blob\Models\ContainerAcl::addSignedIdentifier
     */
    public function testCreateEmpty()
    {
        // Setup
        $sample = Resources::EMPTY_STRING;
        $expectedEtag = '0x8CAFB82EFF70C46';
        $expectedLastModified = 'Sun, 25 Sep 2011 19:42:18 GMT';
        $expectedDate = WindowsAzureUtilities::rfc1123ToDateTime($expectedLastModified);
        $expectedPublicAccess = 'container';
        
        // Test
        $acl = ContainerAcl::create($expectedPublicAccess, $expectedEtag, 
            $expectedLastModified, $sample);
        
        // Assert
        $this->assertEquals($expectedEtag, $acl->getEtag());
        $this->assertEquals($expectedDate, $acl->getLastModified());
        $this->assertEquals($expectedPublicAccess, $acl->getPublicAccess());
        $this->assertCount(0, $acl->getSignedIdentifiers());
    }
    
    /**
     * @covers PEAR2\WindowsAzure\Services\Blob\Models\ContainerAcl::create
     * @covers PEAR2\WindowsAzure\Services\Blob\Models\ContainerAcl::getEtag
     * @covers PEAR2\WindowsAzure\Services\Blob\Models\ContainerAcl::getLastModified
     * @covers PEAR2\WindowsAzure\Services\Blob\Models\ContainerAcl::getPublicAccess
     * @covers PEAR2\WindowsAzure\Services\Blob\Models\ContainerAcl::getSignedIdentifiers
     * @covers PEAR2\WindowsAzure\Services\Blob\Models\ContainerAcl::addSignedIdentifier
     */
    public function testCreateOneEntry()
    {
        // Setup
        $sample = TestResources::getContainerAclOneEntrySample();
        $expectedEtag = '0x8CAFB82EFF70C46';
        $expectedLastModified = 'Sun, 25 Sep 2011 19:42:18 GMT';
        $expectedDate = WindowsAzureUtilities::rfc1123ToDateTime($expectedLastModified);
        $expectedPublicAccess = 'container';
        
        // Test
        $acl = ContainerAcl::create($expectedPublicAccess, $expectedEtag, 
            $expectedLastModified, $sample['SignedIdentifiers']);
        
        // Assert
        $this->assertEquals($expectedEtag, $acl->getEtag());
        $this->assertEquals($expectedDate, $acl->getLastModified());
        $this->assertEquals($expectedPublicAccess, $acl->getPublicAccess());
        $this->assertCount(1, $acl->getSignedIdentifiers());
    }
    
    /**
     * @covers PEAR2\WindowsAzure\Services\Blob\Models\ContainerAcl::create
     * @covers PEAR2\WindowsAzure\Services\Blob\Models\ContainerAcl::getEtag
     * @covers PEAR2\WindowsAzure\Services\Blob\Models\ContainerAcl::getLastModified
     * @covers PEAR2\WindowsAzure\Services\Blob\Models\ContainerAcl::getPublicAccess
     * @covers PEAR2\WindowsAzure\Services\Blob\Models\ContainerAcl::getSignedIdentifiers
     * @covers PEAR2\WindowsAzure\Services\Blob\Models\ContainerAcl::addSignedIdentifier
     */
    public function testCreateMultipleEntries()
    {
        // Setup
        $sample = TestResources::getContainerAclMultipleEntriesSample();
        $expectedEtag = '0x8CAFB82EFF70C46';
        $expectedLastModified = 'Sun, 25 Sep 2011 19:42:18 GMT';
        $expectedDate = WindowsAzureUtilities::rfc1123ToDateTime($expectedLastModified);
        $expectedPublicAccess = 'container';
        
        // Test
        $acl = ContainerAcl::create($expectedPublicAccess, $expectedEtag, 
            $expectedLastModified, $sample['SignedIdentifiers']);
        
        // Assert
        $this->assertEquals($expectedEtag, $acl->getEtag());
        $this->assertEquals($expectedDate, $acl->getLastModified());
        $this->assertEquals($expectedPublicAccess, $acl->getPublicAccess());
        $this->assertCount(2, $acl->getSignedIdentifiers());
        
        return $acl;
    }
    
    /**
     * @covers PEAR2\WindowsAzure\Services\Blob\Models\ContainerAcl::setSignedIdentifiers
     * @covers PEAR2\WindowsAzure\Services\Blob\Models\ContainerAcl::getSignedIdentifiers
     */
    public function testSetSignedIdentifiers()
    {
        // Setup
        $sample = TestResources::getContainerAclOneEntrySample();
        $expectedEtag = '0x8CAFB82EFF70C46';
        $expectedLastModified = 'Sun, 25 Sep 2011 19:42:18 GMT';
        $expectedDate = WindowsAzureUtilities::rfc1123ToDateTime($expectedLastModified);
        $expectedPublicAccess = 'container';
        $acl = ContainerAcl::create($expectedPublicAccess, $expectedEtag, 
            $expectedLastModified, $sample['SignedIdentifiers']);
        $expected = $acl->getSignedIdentifiers();
        $expected[0]->setId('newXid');
        
        // Test
        $acl->setSignedIdentifiers($expected);
        
        // Assert
        $this->assertEquals($expectedEtag, $acl->getEtag());
        $this->assertEquals($expectedDate, $acl->getLastModified());
        $this->assertEquals($expectedPublicAccess, $acl->getPublicAccess());
        $this->assertEquals($expected, $acl->getSignedIdentifiers());
    }
    
    /**
     * @covers PEAR2\WindowsAzure\Services\Blob\Models\ContainerAcl::setLastModified
     * @covers PEAR2\WindowsAzure\Services\Blob\Models\ContainerAcl::getLastModified
     */
    public function testSetLastModified()
    {
        // Setup
        $expected = WindowsAzureUtilities::rfc1123ToDateTime('Sun, 25 Sep 2011 19:42:18 GMT');
        $acl = new ContainerAcl();
        $acl->setLastModified($expected);
        
        // Test
        $acl->setLastModified($expected);
        
        // Assert
        $this->assertEquals($expected, $acl->getLastModified());
    }
    
    /**
     * @covers PEAR2\WindowsAzure\Services\Blob\Models\ContainerAcl::setEtag
     * @covers PEAR2\WindowsAzure\Services\Blob\Models\ContainerAcl::getEtag
     */
    public function testSetEtag()
    {
        // Setup
        $expected = '0x8CAFB82EFF70C46';
        $acl = new ContainerAcl();
        $acl->setEtag($expected);
        
        // Test
        $acl->setEtag($expected);
        
        // Assert
        $this->assertEquals($expected, $acl->getEtag());
    }
    
    /**
     * @covers PEAR2\WindowsAzure\Services\Blob\Models\ContainerAcl::setPublicAccess
     * @covers PEAR2\WindowsAzure\Services\Blob\Models\ContainerAcl::getPublicAccess
     */
    public function testSetPublicAccess()
    {
        // Setup
        $expected = 'container';
        $acl = new ContainerAcl();
        $acl->setPublicAccess($expected);
        
        // Test
        $acl->setPublicAccess($expected);
        
        // Assert
        $this->assertEquals($expected, $acl->getPublicAccess());
    }
    
    /**
     * @covers PEAR2\WindowsAzure\Services\Blob\Models\ContainerAcl::toXml
     * @covers PEAR2\WindowsAzure\Services\Blob\Models\ContainerAcl::toArray
     * @depends testCreateMultipleEntries
     */
    public function testToXml($acl)
    {
        // Setup
        $sample = TestResources::getContainerAclMultipleEntriesSample();
        $expected = ContainerAcl::create('container', 
            '123', 'Sun, 25 Sep 2011 19:42:18 GMT', $sample['SignedIdentifiers']);
        
        // Test
        $xml = $acl->toXml();
        
        // Assert
        $array = Utilities::unserialize($xml);
        $acl = ContainerAcl::create('container', '123', 'Sun, 25 Sep 2011 19:42:18 GMT', $array);
        $this->assertEquals($expected->getSignedIdentifiers(), $acl->getSignedIdentifiers());
    }
}

?>
