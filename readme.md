# Felicio
_A simple AWS SQS Messages with PHP_

[![Latest Stable Version](https://poser.pugx.org/geekcom/felicio/v/stable)](https://packagist.org/packages/geekcom/felicio)
[![Minimum PHP Version](https://img.shields.io/badge/php-%3E%3D%207.3-blue.svg?style=flat-square)](https://php.net/)
[![License](https://poser.pugx.org/geekcom/felicio/license)](https://packagist.org/packages/geekcom/felicio)

## About Felicio and SQS

Felicio is a simple library to send and receive(_coming soon_) [AWS SQS Messages](https://aws.amazon.com/pt/sqs/).

- Simple.
- Configurable.
- Testable.
- Open source.

[Amazon Simple Queue Service (SQS)](https://aws.amazon.com/pt/sqs/) is a fully managed message queuing service 
that enables you to decouple and scale microservices, distributed systems, and serverless applications.

## Installation

Install [Composer](http://getcomposer.org) if you don't have it.
```
composer require geekcom/felicio
```
Or in your file'composer.json' add:

```json
{
    "require": {
        "geekcom/felicio": "^1.0.0"
    }
}
```

And the just run:

    composer install

and thats it.

----------------------------------------------------------------------------------------------------------------------------


## Configure

Rename `.felicio.example` to `.felicio` and fill in the correct information about your AWS SQS account.
```
AWS_SQS_ACCESS_KEY=
AWS_SQS_SECRET_KEY=
AWS_SQS_REGION=
```

## Send a message
```php
require __DIR__ . '/vendor/autoload.php';

use Felicio\Felicio;

$felicio = new Felicio();

$felicio->sendMessage('https://sqs.us-west-2.amazonaws.com/000/my_queue', 'message');
```

## Contributing

Feel free to contribute, make a fork!

## License

The Felicio library is open-source software licensed under the [MIT license](https://opensource.org/licenses/MIT).

## [Questions?](https://github.com/felicio/issues)

Open a new [Issue](https://github.com/felicio/issues) or look for a closed issue
