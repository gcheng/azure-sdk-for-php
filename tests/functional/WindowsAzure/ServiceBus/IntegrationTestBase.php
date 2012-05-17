<?php

/**
 * Functional tests for the SDK
 *
 * PHP version 5
 *
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
 * @category   Microsoft
 * @package    Tests\Functional\WindowsAzure\Services\ServiceBus
 * @author     Jason Cooke <jcooke@microsoft.com>
 * @copyright  2012 Microsoft Corporation
 * @license    http://www.apache.org/licenses/LICENSE-2.0  Apache License 2.0
 * @link       http://pear.php.net/package/azure-sdk-for-php
 */

namespace Tests\Functional\WindowsAzure\Services\ServiceBus;

use Tests\Framework\FiddlerFilter;
use Tests\Framework\ServiceBusRestProxyTestBase;
use WindowsAzure\Services\ServiceBus\ServiceBusService;

class IntegrationTestBase extends ServiceBusRestProxyTestBase {
    public function __construct()
    {
        parent::__construct();
        $fiddlerFilter = new FiddlerFilter();
        $this->wrapper = $this->wrapper->withFilter($fiddlerFilter);
    }
    
    public function setUp() {
        parent::setUp();
        $this->initialize();
    }

    public static function setUpBeforeClass() {
        parent::setUpBeforeClass();
    }

    public function initialize() {
//        $testAlphaExists = false;
//        foreach(iterateQueues($this->wrapper) as $queue)  {
//            $queueName = $queue->getPath();
//            if ($queueName->startsWith('Test') || $queueName->startsWith('test')) {
//                if ($queueName->equalsIgnoreCase('TestAlpha')) {
//                    $testAlphaExists = true;
//                    $count = $queue->getMessageCount();
//                    for ($i = 0; $i != $count; $i++) {
//                        $opts = new ReceiveMessageOptions();
//                        $opts->setTimeout(20);
//                        $this->wrapper->receiveQueueMessage($queueName, $opts);
//                    }
//                }
//                else {
//                    $service->deleteQueue($queueName);
//                }
//            }
//        }
//        foreach(iterateTopics($service) as $topic)  {
//            $topicName = $topic->getPath();
//            if ($topicName->startsWith('Test') || $topicName->startsWith('test')) {
//                $service->deleteQueue($topicName);
//            }
//        }
//        if (!$testAlphaExists) {
//            $service->createQueue(new QueueInfo('TestAlpha'));
//        }
    }
}

?>
