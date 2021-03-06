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
 * @package   PEAR2\Tests\Unit\WindowsAzure
 * @author    Abdelrahman Elogeel <Abdelrahman.Elogeel@microsoft.com>
 * @copyright 2012 Microsoft Corporation
 * @license   http://www.apache.org/licenses/LICENSE-2.0  Apache License 2.0
 * @link      http://pear.php.net/package/azure-sdk-for-php
 */

use PEAR2\WindowsAzure\Services\Core\ServiceRestProxy;
use PEAR2\WindowsAzure\Core\HttpClient;
use PEAR2\WindowsAzure\Core\Url;
use PEAR2\Tests\Mock\WindowsAzure\Services\Core\Filters\SimpleFilterMock;
use PEAR2\WindowsAzure\Services\Blob\Models\AccessCondition;
use PEAR2\WindowsAzure\Services\Blob\Models\AccessConditionHeaderType;

/**
 * Unit tests for class ServiceRestProxy
 *
 * @category  Microsoft
 * @package   PEAR2\Tests\Unit\WindowsAzure
 * @author    Abdelrahman Elogeel <Abdelrahman.Elogeel@microsoft.com>
 * @copyright 2012 Microsoft Corporation
 * @license   http://www.apache.org/licenses/LICENSE-2.0  Apache License 2.0
 * @version   Release: @package_version@
 * @link      http://pear.php.net/package/azure-sdk-for-php
 */
class ServiceRestProxyTest extends PHPUnit_Framework_TestCase
{
    /**
     * @covers PEAR2\WindowsAzure\Services\Core\ServiceRestProxy::__construct
     */
    public function test__construct()
    {
        // Setup
        $channel = new HttpClient();
        $url     = new Url('http://www.microsoft.com');
        
        // Test
        $actual = new ServiceRestProxy($channel, $url);
        
        // Assert
        $this->assertTrue(isset($actual));
        
        return $actual;
    }
    
    /**
     * @covers  PEAR2\WindowsAzure\Services\Core\ServiceRestProxy::withFilter
     * @depends test__construct
     */
    public function testWithFilter($restWrapper)
    {
        // Setup
        $filter = new SimpleFilterMock('name', 'value');
        
        // Test
        $actual = $restWrapper->withFilter($filter);
        
        // Assert
        $this->assertCount(1, $actual->getFilters());
        $this->assertCount(0, $restWrapper->getFilters());
    }
    
    /**
     * @covers  PEAR2\WindowsAzure\Services\Core\ServiceRestProxy::getFilters
     * @depends test__construct
     */
    public function testGetFilters($restWrapper)
    {
        // Setup
        $filter = new SimpleFilterMock('name', 'value');
        $withFilter = $restWrapper->withFilter($filter);
        
        // Test
        $actual1 = $withFilter->getFilters();
        $actual2 = $restWrapper->getFilters();
        
        // Assert
        $this->assertCount(1, $actual1);
        $this->assertCount(0, $actual2);
    }
    
    /**
     * @covers  PEAR2\WindowsAzure\Services\Core\ServiceRestProxy::addOptionalAccessConditionHeader
     * @depends test__construct
     */
    public function testAddOptionalAccessContitionHeader($restWrapper)
    {
        // Setup
        $expectedHeader = AccessConditionHeaderType::IF_MATCH;
        $expectedValue = '0x8CAFB82EFF70C46';
        $accessCondition = AccessCondition::ifMatch($expectedValue);
        $headers = array('Header1' => 'Value1', 'Header2' => 'Value2');
        
        // Test
        $actual = $restWrapper->addOptionalAccessConditionHeader($headers, $accessCondition);
        
        // Assert
        $this->assertCount(3, $actual);
        $this->assertEquals($expectedValue, $actual[$expectedHeader]);
    }
    
    /**
     * @covers  PEAR2\WindowsAzure\Services\Core\ServiceRestProxy::groupQueryValues
     * @depends test__construct
     */
    public function testGroupQueryValues($restWrapper)
    {
        // Setup
        $values = array('A', 'B', 'C');
        $expected = 'A,B,C';
        
        // Test
        $actual = $restWrapper->groupQueryValues($values);
        
        // Assert
        $this->assertEquals($expected, $actual);
    }
    
    /**
     * @covers  PEAR2\WindowsAzure\Services\Core\ServiceRestProxy::groupQueryValues
     * @depends test__construct
     */
    public function testGroupQueryValuesWithNulls($restWrapper)
    {
        // Setup
        $values = array(null, '', null);
        
        // Test
        $actual = $restWrapper->groupQueryValues($values);
        
        // Assert
        $this->assertTrue(empty($actual));
    }
    
    /**
     * @covers  PEAR2\WindowsAzure\Services\Core\ServiceRestProxy::groupQueryValues
     * @depends test__construct
     */
    public function testGroupQueryValuesWithMix($restWrapper)
    {
        // Setup
        $values = array(null, 'B', 'C', '');
        $expected = 'B,C';
        
        // Test
        $actual = $restWrapper->groupQueryValues($values);
        
        // Assert
        $this->assertEquals($expected, $actual);
    }
}

?>
