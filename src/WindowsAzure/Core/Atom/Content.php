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
 * @package   WindowsAzure\Services\ServiceBus
 * @author    Azure PHP SDK <azurephpsdk@microsoft.com>
 * @copyright 2012 Microsoft Corporation
 * @license   http://www.apache.org/licenses/LICENSE-2.0  Apache License 2.0
 * @link      http://pear.php.net/package/azure-sdk-for-php
 */

namespace WindowsAzure\Core\Atom;
use WindowsAzure\Utilities;
use WindowsAzure\Resources;

/**
 * This class constructs HTTP requests and receive HTTP responses for service bus.
 *
 * @category  Microsoft
 * @package   WindowsAzure\Services\ServiceBus
 * @author    Azure PHP SDK <azurephpsdk@microsoft.com>
 * @copyright 2012 Microsoft Corporation
 * @license   http://www.apache.org/licenses/LICENSE-2.0  Apache License 2.0
 * @version   Release: @package_version@
 * @link      http://pear.php.net/package/azure-sdk-for-php
 */

class Content
{
    /**
     * The text of the content. 
     *
     * @var string  
     */
    private $_text;

    /**
     * The type of the content. 
     *
     * @var string  
     */
    private $_type;
     
    /** 
     * Creates a Content instance with specified text.
     *
     * @param string $text The text of the content.
     */
    public function __construct($text = null)
    {
        $this->_text = $text;
    }

    /**
     * Creates an ATOM CONTENT instance with specified xml string. 
     * 
     * @param string $xmlString an XML based string of ATOM CONTENT.
     */ 
    public static function create($xmlString)
    {
        var_dump("content XML string: " . $xmlString);
        $content = new Content();
        $contentXml = simplexml_load_string($xmlString);
        $attributes = $contentXml->attributes();
       
//        $foo = array();
//        foreach ($attributes as $key => $value) {
//            $foo[$key] = $value;
//        }
//        $attributes = $foo;
//   
//        $foo = array();
//        foreach ($contentXml as $key => $value) {
//            $foo[$key] = $value;
//        }
//        $contentXml = $foo;
        
        if (array_key_exists('type', $attributes))
        {
            $content->setType($attributes['type']);
        }
        $content->setText((string)$contentXml->InnerNode);
        return $content;
    }

    /** 
     * Gets the text of the content. 
     *
     * @return string
     */
    public function getText()
    {   
        return $this->_text;
    } 

    /**
     * Sets the text of the content.
     * 
     * @param string $text The text of the content.
     */
    public function setText($text)
    {
        $this->_text = $text; 
    }

    /**
     * Gets the type of the content. 
     * 
     * @return string
     */
    public function getType()
    {
        return $this->_type;
    }

    /**
     * Sets the type of the content. 
     * 
     * @param string $type The type of the content.
     */
    public function setType($type)
    {
        $this->_type = $type;
    }
    
    /** 
     * Gets an XML representing the content. 
     * 
     * return string
     */
    public function toXml()
    {
        $xmlWriter = new \XMLWriter();
        $xmlWriter->openMemory();
        $xmlWriter->startElement('atom:content');
        if (!empty($this->_type))
        {
            $xmlWriter->writeAttribute('type', $this->_type);
        }

        $xmlWriter->writeRaw($this->_text);
        $xmlWriter->endElement();

        return $xmlWriter->outputMemory();
    }
}
?>
