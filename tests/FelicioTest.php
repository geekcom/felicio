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
}