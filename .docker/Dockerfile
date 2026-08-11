FROM php:8.4-cli

LABEL maintainer="geekcom"

RUN apt-get update && apt-get install -y \
    curl \
    git \
    unzip \
    libzip-dev \
    && rm -rf /var/lib/apt/lists/*

RUN docker-php-ext-install zip

# Xdebug
RUN pecl install xdebug \
    && docker-php-ext-enable xdebug

# Composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# PHP CodeSniffer
RUN curl -fsSL https://phars.phpcodesniffer.com/phpcs.phar \
    -o /usr/local/bin/phpcs \
    && chmod +x /usr/local/bin/phpcs

WORKDIR /var/www/app