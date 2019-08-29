<?php

/*
 * This file is part of the felicio.
 *
 * (c) Daniel Rodrigues (geekcom)
 *
 * For the full copyright and license information, please view the LICENSE.md
 * file that was distributed with this source code.
 */

namespace Felicio\Test;

use Felicio\Felicio;
use PHPUnit\Framework\TestCase;
use Symfony\Component\Dotenv\Dotenv;

final class FelicioTest Extends TestCase
{
    private $instance;

    private $env;

    public function setUp(): void
    {
        $this->env = new Dotenv();
        $this->instance = new Felicio();

        $this->env->load(__DIR__ . '/../.felicio');
    }

    public function testSendMessageWithoutParameters()
    {
        $this->expectException(\ArgumentCountError::class);

        $this->instance->sendMessage('', '');
    }
}