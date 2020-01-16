<?php

declare(strict_types=1);

namespace Felicio\Contracts;

use Aws\Result;

interface FelicioContract
{
    public function sendMessage(array $params): string;

    public function receiveMessage(array $params): ?array;

    public function deleteMessage(array $params): Result;
}