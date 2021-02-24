# syntax=docker/dockerfile:1.0-experimental
FROM php:7.4-fpm as phpbase
RUN apt-get update && apt-get install -y \
        libc-client-dev \
        libfreetype6-dev \
        libjpeg62-turbo-dev \
        libpng-dev \
        libcurl4-openssl-dev \
        libgmp3-dev \
        libkrb5-dev \
        libicu-dev \
        zlib1g-dev \
        libpng-dev \
        libjpeg-dev \
        libfreetype6-dev \
        libpq-dev \
        libxml2-dev \
        libzip-dev \
        libmagickwand-dev \
    && docker-php-ext-install -j$(nproc) bcmath gd gmp intl mysqli opcache pgsql pdo_mysql soap sockets zip exif \
    && printf "\n" | pecl install imagick \
    && docker-php-ext-enable imagick

COPY ./docker/php/log.conf /usr/local/etc/php-fpm.d/zz-log.conf

WORKDIR /var/www
COPY ./composer* ./
RUN --mount=target=/root/.composer/,type=cache rmdir html \
    && php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');" \
    && php composer-setup.php --quiet \
    && rm composer-setup.php \
    && mv composer.phar /usr/bin \
    && ln -s /usr/bin/composer.phar /usr/bin/composer \
    && composer install --no-scripts --no-autoloader
FROM phpbase as phpapi

VOLUME /var/www/storage
COPY docker/php/migrate.sh /usr/local/bin
COPY --chown=www-data:www-data . /var/www/
RUN chmod +x /usr/local/bin/migrate.sh \
    && chown -R www-data:www-data storage \
    && composer dump-autoload && php artisan route:cache
RUN sh -c 'curl -sL https://deb.nodesource.com/setup_14.x | bash -' \
    && apt-get install -y nodejs git watch

FROM node:12-buster as builder
RUN apt-get update && apt-get install -y \ 
gconf-service libasound2 libatk1.0-0 libc6 libcairo2 libcups2 libdbus-1-3 libexpat1 libfontconfig1 libgcc1 libgconf-2-4 libgdk-pixbuf2.0-0 libglib2.0-0 libgtk-3-0 libnspr4 libpango-1.0-0 libpangocairo-1.0-0 libstdc++6 libx11-6 libx11-xcb1 libxcb1 libxcomposite1 libxcursor1 libxdamage1 libxext6 libxfixes3 libxi6 libxrandr2 libxrender1 libxss1 libxtst6 ca-certificates fonts-liberation libappindicator1 libnss3 lsb-release xdg-utils wget

FROM nginx:latest as webbase
RUN rm -rf /var/www/*
COPY ./docker/nginx/nginx.conf /etc/nginx/nginx.conf
COPY ./docker/nginx/default.conf /etc/nginx/conf.d/default.conf
COPY --chown=www-data:www-data ./storage /var/www/storage

FROM webbase as web
COPY ./public /var/www/public
VOLUME /var/www/storage

