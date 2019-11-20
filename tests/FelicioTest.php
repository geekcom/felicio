<?php

declare(strict_types=1);

namespace Felicio\Test;

use Felicio\Felicio;
use ArgumentCountError;
use PHPUnit\Framework\TestCase;

final class FelicioTest extends TestCase
{
    private $instance;

    public function setUp(): void
    {
        $this->instance = new Felicio(__DIR__ . '/../.felicio');
    }

    /** @test */
    public function sendStandardMessageWithoutRequiredParameters(): void
    {
        $this->expectException(ArgumentCountError::class);

        $params = [
            'QueueUrl' => '',
            'MessageBody' => ''
        ];

        $this->instance->sendMessage($params);
    }

    /** @test */
    public function sendStandardMessage(): void
    {
        $params = [
            'QueueUrl' => '',
            'MessageBody' => 'Message 001'
        ];

        $this->assertIsString($this->instance->sendMessage($params));
    }

    /** @test */
    public function sendFifoMessage(): void
    {
        $params = [
            'QueueUrl' => '.fifo', //required
            'MessageBody' => 'Message 001',
            'MessageDeduplicationId' => 'acac6e8f4ec9f44abc445945e76bf209',
            'MessageGroupId' => '2fe6a413d02e3adef70256a36bf3b969',
        ];

        $this->assertIsString($this->instance->sendMessage($params));
    }

    /** @test */
    public function receiveMessage()
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

    /** @test */
    public function deleteMessage()
    {
        $params = [
            'QueueUrl' => '', //required
            'ReceiptHandle' => '', //required
        ];

        $this->assertIsObject($this->instance->deleteMessage($params));
    }

    /** @test */
    public function deleteMessageWithoutParameters()
    {
        $this->expectException(ArgumentCountError::class);

        $params = [
            'QueueUrl' => '', //required
            'ReceiptHandle' => '', //required
        ];

        $this->instance->deleteMessage($params);
    }

    /** @test */
    public function ifExistsMessage()
    {
        $queueUrl = ''; //required

        $this->assertGreaterThan(1, $this->instance->countMessages($queueUrl));
    }
}