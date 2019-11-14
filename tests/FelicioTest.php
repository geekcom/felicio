<?php

/*
 * This file is part of the felicio.
 *
 * (c) Daniel Rodrigues (geekcom)
 *
 * For the full copyright and license information, please view the LICENSE.md
 * file that was distributed with this source code.
 */

namespace Felicio\Test;

use Felicio\Felicio;
use PHPUnit\Framework\TestCase;
use ArgumentCountError;

final class FelicioTest Extends TestCase
{
    private $instance;

    public function setUp(): void
    {
        $this->instance = new Felicio(__DIR__ . '/../.felicio');
    }

    public function testSendMessageWithoutRequiredParameters()
    {
        $this->expectException(ArgumentCountError::class);

        $params = [
            'QueueUrl' => '',
            'MessageBody' => ''
        ];

        $this->instance->sendMessage($params);
    }

    public function testSendMessage()
    {
        $params = [
            'QueueUrl' => '',
            'MessageBody' => 'Message 001'
        ];

        $this->assertIsString($this->instance->sendMessage($params));
    }

    public function testReceiveMessage()
    {
        $params = [
            'AttributeNames' => ['SentTimestamp'],
            'MaxNumberOfMessages' => 1,
            'MessageAttributeNames' => ['All'],
            'QueueUrl' => '', //required
            'WaitTimeSeconds' => 0,
        ];

        $this->assertIsArray($this->instance->receiveMessage($params));
    }

    public function testDeleteMessage()
    {
        $params = [
            'QueueUrl' => '', //required
            'ReceiptHandle' => '', //required
        ];

        $this->assertEmpty($this->instance->deleteMessage($params));
    }

    public function testDeleteMessageWithoutParameters()
    {
        $this->expectException(ArgumentCountError::class);

        $params = [
            'QueueUrl' => '', //required
            'ReceiptHandle' => '', //required
        ];

        $this->instance->deleteMessage($params);
    }

    public function testIfExistsMessage()
    {
        $queueUrl = ''; //required

        $this->assertGreaterThan(1, $this->instance->countMessages($queueUrl));
    }
}