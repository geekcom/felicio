<?php

namespace Felicio\Contracts;

interface FelicioContract
{
    public function sendMessage($queueURl, $messageBody);
}