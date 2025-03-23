FROM php:8.3-apache

RUN apt-get update && apt-get install -y \
    libicu-dev \
    libzip-dev \
    unzip \
    && docker-php-ext-install intl

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

WORKDIR /var/www
COPY . /var/www/
COPY ./docker/apache.conf /etc/apache2/sites-available/000-default.conf

RUN  APP_ENV=prod composer install --no-dev --optimize-autoloader

RUN chown -R www-data:www-data /var/www/var /var/www/public

EXPOSE 80