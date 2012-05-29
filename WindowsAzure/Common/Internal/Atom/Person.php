<?php

/**
 * LICENSE: Licensed under the Apache License, Version 2.0 (the "License");;
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
 * @package   WindowsAzure\ServiceBus\Internal\Atom
 * @author    Azure PHP SDK <azurephpsdk@microsoft.com>
 * @copyright 2012 Microsoft Corporation
 * @license   http://www.apache.org/licenses/LICENSE-2.0  Apache License 2.0
 * @link      http://pear.php.net/package/azure-sdk-for-php
 */

namespace WindowsAzure\Common\Internal\Atom;
use WindowsAzure\Common\Internal\Utilities;
use WindowsAzure\Common\Internal\Resources;

/**
 * This class constructs HTTP requests and receive HTTP responses for service bus.
 *
 * @category  Microsoft
 * @package   WindowsAzure\ServiceBus\Internal\Atom
 * @author    Azure PHP SDK <azurephpsdk@microsoft.com>
 * @copyright 2012 Microsoft Corporation
 * @license   http://www.apache.org/licenses/LICENSE-2.0  Apache License 2.0
 * @version   Release: @package_version@
 * @link      http://pear.php.net/package/azure-sdk-for-php
 */

class Person
{
    /**
     * The name of the person. 
     *
     * @var string  
     */
    protected $_name;

    /**
     * The Uri of the person. 
     *
     * @var string  
     */
    protected $_uri;

    /**
     * The email of the person.
     *
     * @var string 
     */
    protected $_email;
     
    /** 
     * Creates an ATOM person instance with specified name.
     *
     * @param string $name The name of the person.
     */
    public function __construct($name = Resources::EMPTY_STRING)
    {
        $this->_name = $name;
    }

    public function parseXml($xmlString)
    {
        $personXml = simplexml_load_string($xmlString);
        $attributes = $personXml->attributes();
        $personArray = (array)$personXml;

        if (array_key_exists('name', $personArray))
        {
            $this->_name = (string)$personArray['name'];
        }

        if (array_key_exists('uri', $personArray))
        {
            $this->_uri = (string)$personArray['uri'];
        }

        if (array_key_exists('email', $personArray))
        {
            $this->_email = (string)$personArray['email'];
        }
    }

    /** 
     * Gets the name of the person. 
     *
     * @return string
     */
    public function getName()
    {   
        return $this->_name;
    } 

    /**
     * Sets the name of the person.
     * 
     * @param string $name The name of the person.
     */
    public function setName($name)
    {
        $this->_name = $name; 
    }

    /**
     * Gets the URI of the person. 
     * 
     * @return string
     */
    public function getUri()
    {
        return $this->_uri;
    }

    /**
     * Sets the URI of the person. 
     * 
     * @param string $uri The URI of the person.
     */
    public function setUri($uri)
    {
        $this->_uri = $uri;
    }

    
    /**
     * Gets the email of the person. 
     * 
     * @return string
     */
    public function getEmail()
    {
        return $this->_email;
    }

    /**
     * Sets the email of the person. 
     * 
     * @param string $email The email of the person.
     */
    public function setEmail($email)
    {
        $this->_email = $email;
    }

    /** 
     * Gets an XML representing the person. 
     * 
     * return string
     */
    public function toXml()
    {
        $xmlWriter = new XMLWriter();

        $xmlWriter->openMemory();
        $xmlWriter->startElement('<atom:person>');
        $xmlWriter->writeElement('<atom:name>', $this->_name);
        if (!empty($this->_uri))
        {
            $xmlWriter->writeElement('atom:uri', $this->_uri);
        }

        if (!empty($this->_email))
        {
            $xmlWriter->writeElement('atom:email', $this->_email);
        }
        
        $xmlWriter->endElement();
        
        return $xmlWriter->outputMemory();
    }
}
?>