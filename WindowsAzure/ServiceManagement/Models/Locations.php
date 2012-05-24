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
 * @package   WindowsAzure\ServiceManagement\Models
 * @author    Azure PHP SDK <azurephpsdk@microsoft.com>
 * @copyright 2012 Microsoft Corporation
 * @license   http://www.apache.org/licenses/LICENSE-2.0  Apache License 2.0
 * @link      http://pear.php.net/package/azure-sdk-for-php
 */
 
namespace WindowsAzure\ServiceManagement\Models;

/**
 * Available data center locations on Windows Azure.
 *
 * @category  Microsoft
 * @package   WindowsAzure\ServiceManagement\Models
 * @author    Azure PHP SDK <azurephpsdk@microsoft.com>
 * @copyright 2012 Microsoft Corporation
 * @license   http://www.apache.org/licenses/LICENSE-2.0  Apache License 2.0
 * @version   Release: @package_version@
 * @link      http://pear.php.net/package/azure-sdk-for-php
 */
class Locations
{
    const ANYWHERE_US      = 'Anywhere US';
    const NORTH_CENTRAL_US = 'North Central US';
    const SOUTH_CENTRAL_US = 'South Central US';
    const WEST_US          = 'West US';
    const EAST_US          = 'East US';
    const ANYWHERE_EUROPE  = 'Anywhere Europe';
    const WEST_EUROPE      = 'West Europe';
    const NORTH_EUROPE     = 'North Europe';
    const ANYWHERE_ASIA    = 'Anywhere Asia';
    const SOUTHEAST_ASIA   = 'Southeast Asia';
    const EAST_ASIA        = 'East Asia';
    const COUNT            = 11;
}

?>