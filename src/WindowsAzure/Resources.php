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
 * @package   PEAR2\WindowsAzure
 * @author    Abdelrahman Elogeel <Abdelrahman.Elogeel@microsoft.com>
 * @copyright 2012 Microsoft Corporation
 * @license   http://www.apache.org/licenses/LICENSE-2.0  Apache License 2.0
 * @link      http://pear.php.net/package/azure-sdk-for-php
 */
 
namespace PEAR2\WindowsAzure;

/**
 * Project resources.
 *
 * @category  Microsoft
 * @package   PEAR2\WindowsAzure
 * @author    Abdelrahman Elogeel <Abdelrahman.Elogeel@microsoft.com>
 * @copyright 2012 Microsoft Corporation
 * @license   http://www.apache.org/licenses/LICENSE-2.0  Apache License 2.0
 * @version   Release: @package_version@
 * @link      http://pear.php.net/package/azure-sdk-for-php
 */
class Resources
{
    // Messages
    const INVALID_TYPE_MSG    = 'The provided variable should be of type: ';
    const INVALID_META_MSG    = 'Metadata cannot contain newline characters';
    const AZURE_ERROR_MSG     = "Fail:\nCode: %s\nValue: %s\ndetails (if any): %s";
    const NOT_IMPLEMENTED_MSG = 'This method is not implemented';
    const NULL_ERROR_MSG      = 'Value can\'t be NULL or empty.';
    const INVALID_URL_MSG     = 'Provided URL is invalid';
    const INVALID_HT_MSG      = 'The header type provided is invalid';

    // HTTP Headers
    const X_MS_HEADER_PREFIX               = 'x-ms-';
    const X_MS_META_HEADER_PREFIX          = 'x-ms-meta-';
    const X_MS_APPROXIMATE_MESSAGES_COUNT  = 'x-ms-approximate-messages-count';
    const X_MS_POPRECEIPT                  = 'x-ms-popreceipt';
    const X_MS_TIME_NEXT_VISIBLE           = 'x-ms-time-next-visible';
    const X_MS_BLOB_PUBLIC_ACCESS          = 'x-ms-blob-public-access';
    const X_MS_VERSION                     = 'x-ms-version';
    const X_MS_DATE                        = 'x-ms-date';
    const X_MS_BLOB_SEQUENCE_NUMBER        = 'x-ms-blob-sequence-number';
    const X_MS_BLOB_SEQUENCE_NUMBER_ACTION = 'x-ms-sequence-number-action';
    const X_MS_BLOB_TYPE                   = 'x-ms-blob-type';
    const X_MS_BLOB_CONTENT_TYPE           = 'x-ms-blob-content-type';
    const X_MS_BLOB_CONTENT_ENCODING       = 'x-ms-blob-content-encoding';
    const X_MS_BLOB_CONTENT_LANGUAGE       = 'x-ms-blob-content-language';
    const X_MS_BLOB_CONTENT_MD5            = 'x-ms-blob-content-md5';
    const X_MS_BLOB_CACHE_CONTROL          = 'x-ms-blob-cache-control';
    const X_MS_BLOB_CONTENT_LENGTH         = 'x-ms-blob-content-length';
    const X_MS_RANGE                       = 'x-ms-range';
    const X_MS_RANGE_GET_CONTENT_MD5       = 'x-ms-range-get-content-md5';
    const X_MS_LEASE_ID                    = 'x-ms-lease-id';
    const X_MS_LEASE_STATUS                = 'x-ms-lease-status';
    const X_MS_LEASE_ACTION                = 'x-ms-lease-action';
    const X_MS_DELETE_SNAPSHOTS            = 'x-ms-delete-snapshots';
    const X_MS_PAGE_WRITE                  = 'x-ms-page-write';
    const ETAG                             = 'etag';
    const LAST_MODIFIED                    = 'last-modified';
    const DATE                             = 'date';
    const AUTHENTICATION                   = 'authorization';
    const CONTENT_ENCODING                 = 'content-encoding';
    const CONTENT_LANGUAGE                 = 'content-language';
    const CONTENT_LENGTH                   = 'content-length';
    const CONTENT_MD5                      = 'content-md5';
    const CONTENT_TYPE                     = 'content-type';
    const CONTENT_RANGE                    = 'content-range';
    const CACHE_CONTROL                    = 'cache-control';
    const IF_MODIFIED_SINCE                = 'if-modified-since';
    const IF_MATCH                         = 'if-match';
    const IF_NONE_MATCH                    = 'if-none-match';
    const IF_UNMODIFIED_SINCE              = 'if-unmodified-since';
    const RANGE                            = 'range';

    // Type
    const QUEUE_TYPE_NAME = 'IQueue';
    const BLOB_TYPE_NAME  = 'IBlob';
    
    // Misc
    const EMPTY_STRING       = '';
    const SEPARATOR          = ',';
    const AZURE_DATE_FORMAT  = 'D, d M Y H:i:s T';
    const EMULATED           = 'EMULATED';
    const DEV_STORE_NAME     = 'devstoreaccount1';
    const DEV_STORE_KEY      = 'Eby8vdM02xNOcqFlqUwJPLlmEtlCDXJ1OUzFT50uSRZ6IFsuFq2UVErCz4I6tq/K1SZFPTOtr/KBHBeksoGMGw==';
    const EMULATOR_QUEUE_URI = '127.0.0.1:10001';
    const EMULATOR_BLOB_URI  = '127.0.0.1:10000';

    // Versioning
    const API_VERSION = '2011-08-18';

    // Query parameter names
    const QP_PREFIX      = 'Prefix';
    const QP_MAX_RESULTS = 'MaxResults';
    const QP_METADATA    = 'Metadata';
    const QP_MARKER      = 'Marker';
    const QP_NEXT_MARKER = 'NextMarker';
    const QP_COMP        = 'comp';
    const QP_INCLUDE     = 'include';
    const QP_TIMEOUT     = 'timeout';
    const QP_DELIMITER   = 'Delimiter';
    const QP_REST_TYPE   = 'restype';
    const QP_SNAPSHOT    = 'snapshot';
    
    // Request body content types
    const XML_CONTENT_TYPE = 'application/x-www-form-urlencoded';
    const BINARY_FILE_TYPE = 'application/octet-stream';
    
    // Status Codes
    const STATUS_OK         = 200;
    const STATUS_CREATED    = 201;
    const STATUS_ACCEPTED   = 202;
    const STATUS_NO_CONTENT = 204;
    
    // HTTP_Request2 config parameter names
    const USE_BRACKETS    = 'use_brackets';
    const SSL_VERIFY_PEER = 'ssl_verify_peer';
    const SSL_VERIFY_HOST = 'ssl_verify_host';
    const CONNECT_TIMEOUT = 'connect_timeout';
}

?>
