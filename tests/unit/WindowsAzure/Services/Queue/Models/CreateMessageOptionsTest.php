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

use PEAR2\WindowsAzure\Services\Queue\Models\CreateMessageOptions;

/**
 * Unit tests for class CreateMessageOptions
 *
 * @category  Microsoft
 * @package   PEAR2\Tests\Unit\WindowsAzure
 * @author    Abdelrahman Elogeel <Abdelrahman.Elogeel@microsoft.com>
 * @copyright 2012 Microsoft Corporation
 * @license   http://www.apache.org/licenses/LICENSE-2.0  Apache License 2.0
 * @version   Release: @package_version@
 * @link      http://pear.php.net/package/azure-sdk-for-php
 */
class CreateMessageOptionsTest extends PHPUnit_Framework_TestCase
{
    /**
     * @covers PEAR2\WindowsAzure\Services\Queue\Models\CreateMessageOptions::getVisibilityTimeoutInSeconds
     */
    public function testGetVisibilityTimeoutInSeconds()
    {
        // Setup
        $createMessageOptions = new CreateMessageOptions();
        $expected = 1000;
        $createMessageOptions->setVisibilityTimeoutInSeconds($expected);
        
        // Test
        $actual = $createMessageOptions->getVisibilityTimeoutInSeconds();
        
        // Assert
        $this->assertEquals($expected, $actual);
    }
    
    /**
     * @covers PEAR2\WindowsAzure\Services\Queue\Models\CreateMessageOptions::setVisibilityTimeoutInSeconds
     */
    public function testSetVisibilityTimeoutInSeconds()
    {
        // Setup
        $createMessageOptions = new CreateMessageOptions();
        $expected = 1000;
        
        // Test
        $createMessageOptions->setVisibilityTimeoutInSeconds($expected);
        
        // Assert
        $actual = $createMessageOptions->getVisibilityTimeoutInSeconds();
        $this->assertEquals($expected, $actual);
    }
    
    /**
     * @covers PEAR2\WindowsAzure\Services\Queue\Models\CreateMessageOptions::getTimeToLiveInSeconds
     */
    public function testGetTimeToLiveInSeconds()
    {
        // Setup
        $createMessageOptions = new CreateMessageOptions();
        $expected = 20;
        $createMessageOptions->setTimeToLiveInSeconds($expected);
        
        // Test
        $actual = $createMessageOptions->getTimeToLiveInSeconds();
        
        // Assert
        $this->assertEquals($expected, $actual);
    }
    
    /**
     * @covers PEAR2\WindowsAzure\Services\Queue\Models\CreateMessageOptions::setTimeToLiveInSeconds
     */
    public function testSetTimeToLiveInSeconds()
    {
        // Setup
        $createMessageOptions = new CreateMessageOptions();
        $expected = 20;
        
        // Test
        $createMessageOptions->setTimeToLiveInSeconds($expected);
        
        // Assert
        $actual = $createMessageOptions->getTimeToLiveInSeconds();
        $this->assertEquals($expected, $actual);
    }
}

?>
