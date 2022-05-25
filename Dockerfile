FROM php:7.4-fpm-alpine

WORKDIR /var/www/html

RUN docker-php-ext-install pdo pdo_mysql sockets

RUN apk update && apk add libpng-dev

RUN docker-php-ext-install gd
