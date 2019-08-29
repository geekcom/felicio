<?php

namespace Felicio\Contracts;

interface FelicioContract
{
    public function config();

    public function sendMessage($queueURl, $messageBody);
}