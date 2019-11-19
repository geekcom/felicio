<?php

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
    public function sendMessageWithoutRequiredParameters()
    {
        $this->expectException(ArgumentCountError::class);

        $params = [
            'QueueUrl' => '',
            'MessageBody' => ''
        ];

        $this->instance->sendMessage($params);
    }

    /** @test */
    public function sendMessage()
    {
        $params = [
            'QueueUrl' => '',
            'MessageBody' => 'Message 001'
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

        $this->assertEmpty($this->instance->deleteMessage($params));
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