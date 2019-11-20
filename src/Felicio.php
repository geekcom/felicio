<?php

declare(strict_types=1);

namespace Felicio;

use Felicio\Contracts\FelicioContract;
use Aws\Sdk;
use Aws\Exception\AwsException;
use Aws\Credentials\Credentials;
use Aws\Result;
use Symfony\Component\Dotenv\Dotenv;

final class Felicio implements FelicioContract
{
    protected $felicioClient;

    public function __construct($felicioDotFile)
    {
        $dotenv = new Dotenv();
        $dotenv->load($felicioDotFile);

        $credentials = new Credentials(
            $_ENV['AWS_SQS_ACCESS_KEY'],
            $_ENV['AWS_SQS_SECRET_KEY']
        );

        $configs = [
            'credentials' => $credentials,
            'region' => $_ENV['AWS_SQS_REGION'],
            'version' => $_ENV['AWS_SQS_API_VERSION'],
        ];

        $sdk = new Sdk($configs);

        $this->felicioClient = $sdk->createSqs();
    }

    public function sendMessage(array $params): string
    {
        try {
            return (string)$this->felicioClient->sendMessage($params)->get('MessageId');
        } catch (AwsException $e) {
            throw new AwsException();
        }
    }

    public function receiveMessage(array $params): array
    {
        try {
            return $this->felicioClient->receiveMessage($params)->get('Messages');
        } catch (AwsException $e) {
            throw new AwsException();
        }
    }

    public function deleteMessage(array $params): Result
    {
        try {
            return $this->felicioClient->deleteMessage($params);
        } catch (AwsException $e) {
            throw new AwsException();
        }
    }

    public function countMessages($queue): int
    {
        $response = $this->felicioClient->getQueueAttributes(
            [
                'QueueUrl' => $queue,
                'AttributeNames' => ['ApproximateNumberOfMessages'],
            ]
        );

        $attributes = $response->get('Attributes');

        return (int)$attributes['ApproximateNumberOfMessages'];
    }
}