<?php

namespace Felicio;

use Felicio\Contracts\FelicioContract;
use Aws\Sqs\SqsClient;
use Aws\Exception\AwsException;
use Symfony\Component\Dotenv\Dotenv;

final class Felicio implements FelicioContract
{
    public function config()
    {
        $dotenv = new Dotenv();
        $dotenv->load(__DIR__ . '/../.felicio');

        return
            $client = SqsClient::factory([
                'credentials' => [
                    'key' => $_ENV['AWS_SQS_ACCESS_KEY'],
                    'secret' => $_ENV['AWS_SQS_SECRET_KEY']
                ],
                'region' => $_ENV['AWS_SQS_REGION'],
                'version' => 'latest'
            ]);
    }

    public function sendMessage($queueURl, $messageBody)
    {
        $client = $this->config();

        try {
            $client->sendMessage([
                'QueueUrl' => $queueURl,
                'MessageBody' => $messageBody,
            ]);
        } catch (AwsException $e) {
            throw new AwsException();
        }
    }
}