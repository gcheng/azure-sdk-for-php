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
 * @package   PEAR2\Tests\Unit\WindowsAzure\ServiceRuntime
 * @author    Abdelrahman Elogeel <Abdelrahman.Elogeel@microsoft.com>
 * @copyright 2012 Microsoft Corporation
 * @license   http://www.apache.org/licenses/LICENSE-2.0  Apache License 2.0
 * @link      http://pear.php.net/package/azure-sdk-for-php
 */
namespace PEAR2\Tests\Unit\WindowsAzure\ServiceRuntime;
use PEAR2\Tests\Framework\TestResources;
use PEAR2\WindowsAzure\ServiceRuntime\RoleEnvironmentData;
use PEAR2\WindowsAzure\ServiceRuntime\RoleInstance;

/**
 * Unit tests for class RoleEnvironmentData
 *
 * @category  Microsoft
 * @package   PEAR2\Tests\Unit\WindowsAzure\ServiceRuntime\RoleEnvironmentDataTest
 * @author    Abdelrahman Elogeel <Abdelrahman.Elogeel@microsoft.com>
 * @copyright 2012 Microsoft Corporation
 * @license   http://www.apache.org/licenses/LICENSE-2.0  Apache License 2.0
 * @version   Release: @package_version@
 * @link      http://pear.php.net/package/azure-sdk-for-php
 */
class RoleEnvironmentDataTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @covers PEAR2\WindowsAzure\ServiceRuntime\RoleEnvironmentData::__construct
     * @covers PEAR2\WindowsAzure\ServiceRuntime\RoleEnvironmentData::getDeploymentId
     * @covers PEAR2\WindowsAzure\ServiceRuntime\RoleEnvironmentData::getConfigurationSettings
     * @covers PEAR2\WindowsAzure\ServiceRuntime\RoleEnvironmentData::getLocalResources
     * @covers PEAR2\WindowsAzure\ServiceRuntime\RoleEnvironmentData::getCurrentInstance
     * @covers PEAR2\WindowsAzure\ServiceRuntime\RoleEnvironmentData::getRoles
     * @covers PEAR2\WindowsAzure\ServiceRuntime\RoleEnvironmentData::isEmulated
     */
    public function testGetters()
    {
        $deploymentId = 'deploymentId';
        $configurationSettings = array();
        $localResources = array();
        $currentInstance = new RoleInstance(null, null, null, null);
        $roles = array();
        $isEmulated = false;

        // Setup
        $roleEnvironmentData = new RoleEnvironmentData($deploymentId,
            $configurationSettings, $localResources, $currentInstance,
            $roles, $isEmulated);
        
        // Test
        $this->assertEquals($deploymentId,
            $roleEnvironmentData->getDeploymentId());
        
        $this->assertEquals($configurationSettings,
            $roleEnvironmentData->getConfigurationSettings());
        
        $this->assertEquals($localResources,
            $roleEnvironmentData->getLocalResources());
        
        $this->assertEquals($currentInstance,
            $roleEnvironmentData->getCurrentInstance());
        
        $this->assertEquals($roles,
            $roleEnvironmentData->getRoles());
        
        $this->assertEquals($isEmulated,
            $roleEnvironmentData->isEmulated());
    }
}

?>