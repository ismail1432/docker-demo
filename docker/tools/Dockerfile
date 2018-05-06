FROM php:alpine as builder

COPY --from=composer:1.6 /usr/bin/composer /usr/bin/composer

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

FROM node:6.13.1

RUN apt-key adv --keyserver pgp.mit.edu --recv 9D41F3C3 && \
    echo "deb http://dl.yarnpkg.com/debian/ stable main" | tee /etc/apt/sources.list.d/yarn.list && \
    apt-get update && \
    apt-get install yarn

COPY --from=builder . .
