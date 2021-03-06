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
 * @package   PEAR2\WindowsAzure\Services\Blob\Models
 * @author    Abdelrahman Elogeel <Abdelrahman.Elogeel@microsoft.com>
 * @copyright 2012 Microsoft Corporation
 * @license   http://www.apache.org/licenses/LICENSE-2.0  Apache License 2.0
 * @link      http://pear.php.net/package/azure-sdk-for-php
 */
 
namespace PEAR2\WindowsAzure\Services\Blob\Models;
use PEAR2\WindowsAzure\Validate;
use PEAR2\WindowsAzure\Resources;
use PEAR2\WindowsAzure\Utilities;
use PEAR2\WindowsAzure\Core\WindowsAzureUtilities;

/**
 * Holds result of listBlobBlocks
 *
 * @category  Microsoft
 * @package   PEAR2\WindowsAzure\Services\Blob\Models
 * @author    Abdelrahman Elogeel <Abdelrahman.Elogeel@microsoft.com>
 * @copyright 2012 Microsoft Corporation
 * @license   http://www.apache.org/licenses/LICENSE-2.0  Apache License 2.0
 * @version   Release: @package_version@
 * @link      http://pear.php.net/package/azure-sdk-for-php
 */
class ListBlobBlocksResult
{
    /**
     * @var \DateTime
     */
    private $_lastModified;
    
    /**
     * @var string
     */
    private $_etag;
    
    /**
     * @var string
     */
    private $_contentType;
    
    /**
     * @var integer
     */
    private $_contentLength;
    
    /**
     * @var array
     */
    private $_committedBlocks;
    
    /**
     * @var array
     */
    private $_uncommittedBlocks;
    
    /**
     * Gets block entries from parsed response
     * 
     * @param array  $parsed HTTP response
     * @param string $type   Block type
     * 
     * @return array
     */
    private static function _getEntries($parsed, $type)
    {
        $entries = array();
        
        if (is_array($parsed)) {
            $rawEntries = array();
         
            if (is_array($parsed[$type])) {
                $rawEntries = Utilities::getArray($parsed[$type]['Block']);
            }
            
            foreach ($rawEntries as $value) {
                $entries[base64_decode($value['Name'])] = $value['Size'];
            }
        }
        
        return $entries;
    }
    
    /**
     * Creates ListBlobBlocksResult from given response headers and parsed body
     * 
     * @param array $headers HTTP response headers
     * @param array $parsed  HTTP response body in array representation
     * 
     * @return ListBlobBlocksResult
     */
    public static function create($headers, $parsed)
    {
        $result = new ListBlobBlocksResult();
        $clean  = Utilities::keysToLower($headers);
        
        $result->setEtag(Utilities::tryGetValue($clean, Resources::ETAG));
        $date = Utilities::tryGetValue($clean, Resources::LAST_MODIFIED);
        if (!is_null($date)) {
            $date = WindowsAzureUtilities::rfc1123ToDateTime($date);
            $result->setLastModified($date);
        }
        $result->setContentLength(
            intval(
                Utilities::tryGetValue($clean, Resources::X_MS_BLOB_CONTENT_LENGTH)
            )
        );
        $result->setContentType(
            Utilities::tryGetValue($clean, Resources::CONTENT_TYPE)
        );
        
        $result->_uncommittedBlocks = self::_getEntries(
            $parsed, 'UncommittedBlocks'
        );
        $result->_committedBlocks   = self::_getEntries($parsed, 'CommittedBlocks');
        
        return $result;
    }
    
    /**
     * Gets blob lastModified.
     *
     * @return \DateTime.
     */
    public function getLastModified()
    {
        return $this->_lastModified;
    }

    /**
     * Sets blob lastModified.
     *
     * @param \DateTime $lastModified value.
     *
     * @return none.
     */
    public function setLastModified($lastModified)
    {
        Validate::isDate($lastModified);
        $this->_lastModified = $lastModified;
    }

    /**
     * Gets blob etag.
     *
     * @return string.
     */
    public function getEtag()
    {
        return $this->_etag;
    }

    /**
     * Sets blob etag.
     *
     * @param string $etag value.
     *
     * @return none.
     */
    public function setEtag($etag)
    {
        $this->_etag = $etag;
    }
    
    /**
     * Gets blob contentType.
     *
     * @return string.
     */
    public function getContentType()
    {
        return $this->_contentType;
    }

    /**
     * Sets blob contentType.
     *
     * @param string $contentType value.
     *
     * @return none.
     */
    public function setContentType($contentType)
    {
        $this->_contentType = $contentType;
    }
    
    /**
     * Gets blob contentLength.
     *
     * @return integer.
     */
    public function getContentLength()
    {
        return $this->_contentLength;
    }

    /**
     * Sets blob contentLength.
     *
     * @param integer $contentLength value.
     *
     * @return none.
     */
    public function setContentLength($contentLength)
    {
        Validate::isInteger($contentLength);
        $this->_contentLength = $contentLength;
    }
    
    /**
     * Gets uncommitted blocks
     * 
     * @return array
     */
    public function getUncommittedBlock()
    {
        return $this->_uncommittedBlocks;
    }
    
    /**
     * Sets uncommitted blocks
     * 
     * @param array $uncommittedBlocks The uncommitted blocks entries
     * 
     * @return none.
     */
    public function setUncommittedBlock($uncommittedBlocks)
    {
        $this->_uncommittedBlocks = $uncommittedBlocks;
    }
    
    /**
     * Gets committed blocks
     * 
     * @return array
     */
    public function getCommittedBlock()
    {
        return $this->_committedBlocks;
    }
    
    /**
     * Sets committed blocks
     * 
     * @param array $committedBlocks The committed blocks entries
     * 
     * @return none.
     */
    public function setCommittedBlock($committedBlocks)
    {
        $this->_committedBlocks = $committedBlocks;
    }
}

?>
