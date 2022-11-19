FROM php:8.1-fpm AS base

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer
COPY ./infra/docker/app/*.ini /usr/local/etc/php/

WORKDIR /var/www/assets-log

RUN apt-get update \
    && apt-get install -y git libicu-dev zip libzip-dev \
    && docker-php-ext-install intl opcache pdo pdo_mysql \
    && pecl install apcu \
    && docker-php-ext-enable apcu \
    && docker-php-ext-configure zip \
    && docker-php-ext-install zip \
    && pecl install xdebug-3.1.6
