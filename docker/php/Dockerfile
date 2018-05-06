FROM php:7.2-fpm-alpine

RUN apk add --no-cache \
        ca-certificates \
        icu-libs \
        git \
        unzip \
        zlib-dev && \
    apk add --no-cache --virtual .build-deps \
        $PHPIZE_DEPS \
        icu-dev && \
    docker-php-ext-install \
        zip \
        intl \
        mbstring \
        pdo_mysql

WORKDIR '/var/www/html/docker-demo/'

