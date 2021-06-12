FROM php:7.3-fpm-alpine

RUN docker-php-ext-install pdo_mysql

WORKDIR /var/www/html/

RUN php -r "readfile('http://getcomposer.org/installer');" | php -- --install-dir=/usr/bin/ --filename=composer

COPY . .
COPY prod.ev .env

RUN composer install
RUN php artisan migrate
