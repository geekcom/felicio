<?php

declare(strict_types=1);

namespace Felicio\Test;

use Felicio\Felicio;
use ArgumentCountError;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

final class FelicioTest extends TestCase
{
    private Felicio $instance;

    public function setUp(): void
    {
        $this->instance = new Felicio(__DIR__ . '/../.felicio');
    }

    #[Test]
    public function sendStandardMessageWithoutRequiredParameters(): void
    {
        $this->expectException(ArgumentCountError::class);

        $params = [
            'QueueUrl' => '',
            'MessageBody' => ''
        ];

        $this->instance->sendMessage($params);
    }

    #[Test]
    public function sendStandardMessage(): void
    {
        $params = [
            'QueueUrl' => '',
            'MessageBody' => 'Message 001'
        ];

        $this->assertIsString($this->instance->sendMessage($params));
    }

    #[Test]
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

    #[Test]
    public function receiveMessage(): void
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

    #[Test]
    public function deleteMessage(): void
    {
        $params = [
            'QueueUrl' => '', //required
            'ReceiptHandle' => '', //required
        ];

        $this->assertIsObject($this->instance->deleteMessage($params));
    }

    #[Test]
    public function deleteMessageWithoutParameters(): void
    {
        $this->expectException(ArgumentCountError::class);

        $params = [
            'QueueUrl' => '',
            'ReceiptHandle' => '',
        ];

        $this->instance->deleteMessage($params);
    }

    #[Test]
    public function ifExistsMessage(): void
    {
        $queueUrl = ''; //required

        $this->assertGreaterThan(0, $this->instance->countMessages($queueUrl));
    }
}