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

use PEAR2\WindowsAzure\Services\Queue\Models\ListMessagesOptions;

/**
 * Unit tests for class ListMessagesOptions
 *
 * @category  Microsoft
 * @package   PEAR2\Tests\Unit\WindowsAzure
 * @author    Abdelrahman Elogeel <Abdelrahman.Elogeel@microsoft.com>
 * @copyright 2012 Microsoft Corporation
 * @license   http://www.apache.org/licenses/LICENSE-2.0  Apache License 2.0
 * @version   Release: @package_version@
 * @link      http://pear.php.net/package/azure-sdk-for-php
 */
class ListMessagesOptionsTest extends PHPUnit_Framework_TestCase
{
    /**
     * @covers PEAR2\WindowsAzure\Services\Queue\Models\ListMessagesOptions::getVisibilityTimeoutInSeconds
     */
    public function testGetVisibilityTimeoutInSeconds()
    {
        // Setup
        $listMessagesOptions = new ListMessagesOptions();
        $expected = 1000;
        $listMessagesOptions->setVisibilityTimeoutInSeconds($expected);
        
        // Test
        $actual = $listMessagesOptions->getVisibilityTimeoutInSeconds();
        
        // Assert
        $this->assertEquals($expected, $actual);
    }
    
    /**
     * @covers PEAR2\WindowsAzure\Services\Queue\Models\ListMessagesOptions::setVisibilityTimeoutInSeconds
     */
    public function testSetVisibilityTimeoutInSeconds()
    {
        // Setup
        $listMessagesOptions = new ListMessagesOptions();
        $expected = 1000;
        
        // Test
        $listMessagesOptions->setVisibilityTimeoutInSeconds($expected);
        
        // Assert
        $actual = $listMessagesOptions->getVisibilityTimeoutInSeconds();
        $this->assertEquals($expected, $actual);
    }
    
    /**
     * @covers PEAR2\WindowsAzure\Services\Queue\Models\ListMessagesOptions::getNumberOfMessages
     */
    public function testGetNumberOfMessages()
    {
        // Setup
        $listMessagesOptions = new ListMessagesOptions();
        $expected = 10;
        $listMessagesOptions->setNumberOfMessages($expected);
        
        // Test
        $actual = $listMessagesOptions->getNumberOfMessages();
        
        // Assert
        $this->assertEquals($expected, $actual);
    }
    
    /**
     * @covers PEAR2\WindowsAzure\Services\Queue\Models\ListMessagesOptions::setNumberOfMessages
     */
    public function testSetNumberOfMessages()
    {
        // Setup
        $listMessagesOptions = new ListMessagesOptions();
        $expected = 10;
        
        // Test
        $listMessagesOptions->setNumberOfMessages($expected);
        
        // Assert
        $actual = $listMessagesOptions->getNumberOfMessages();
        $this->assertEquals($expected, $actual);
    }
}

?>
