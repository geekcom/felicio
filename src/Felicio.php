<?php

declare(strict_types=1);

namespace Felicio;

use Felicio\Contracts\FelicioContract;
use Aws\Sdk;
use Aws\Credentials\Credentials;
use Aws\Exception\AwsException;
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

    public function sendMessage(array $params): bool
    {
        try {
            $this->felicioClient
                ->sendMessage($params);

            return true;
        } catch (AwsException $e) {
            throw new AwsException();
        }
    }

    public function receiveMessage(array $params): array
    {
        try {
            return $this->felicioClient
                ->receiveMessage($params)
                ->get('Messages');

        } catch (AwsException $e) {
            throw new AwsException();
        }
    }

    public function deleteMessage(array $params): bool
    {
        try {
            $this->felicioClient
                ->deleteMessage($params);

            return true;
        } catch (AwsException $e) {
            throw new AwsException();
        }
    }
}