<?php

namespace Felicio;

use Felicio\Contracts\FelicioContract;
use Aws\Sqs\SqsClient;
use Aws\Exception\AwsException;
use Symfony\Component\Dotenv\Dotenv;

final class Felicio implements FelicioContract
{
    protected $felicioClient;

    public function __construct($dotFelicioFile)
    {
        $dotenv = new Dotenv();
        $dotenv->load($dotFelicioFile);

        $this->felicioClient = SqsClient::factory([
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
        try {
            $this->felicioClient->sendMessage([
                'QueueUrl' => $queueURl,
                'MessageBody' => $messageBody,
            ]);
        } catch (AwsException $e) {
            throw new AwsException();
        }
    }
}