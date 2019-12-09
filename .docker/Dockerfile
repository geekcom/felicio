FROM php:7.4

LABEL maintainer="geekcom"

RUN apt-get update && apt-get install -y \
    curl \
    libzip-dev \
    git

# Build and install PHP extensions #
RUN docker-php-ext-install zip

# install configure xdebug
RUN pecl install xdebug-2.8.0 \
    && docker-php-ext-enable xdebug \
    && echo "zend_extension=$(find /usr/local/lib/php/extensions/ -name xdebug.so)"

# install composer
RUN apt-get update && \
    apt-get -y install curl && \
    curl -sS https://getcomposer.org/installer | \
    php -- --install-dir=/usr/bin/ --filename=composer

# install PHPCS
RUN cd /opt && \
    curl -LO https://squizlabs.github.io/PHP_CodeSniffer/phpcs.phar && \
    cp phpcs.phar /usr/local/bin/phpcs && \
    chmod +x /usr/local/bin/phpcs

WORKDIR "/var/www/app"