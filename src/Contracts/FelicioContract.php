<?php

namespace Felicio\Contracts;

interface FelicioContract
{
    public function sendMessage(array $params);

    public function receiveMessage(array $params);
}