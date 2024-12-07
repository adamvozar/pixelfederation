FROM php:8.3-apache

RUN apt-get update && apt-get install -y \
    libicu-dev zip unzip git curl && \
    docker-php-ext-install intl pdo_mysql

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

WORKDIR /var/www/html

COPY ./app /var/www/html

RUN a2enmod rewrite

RUN chown -R www-data:www-data /var/www/html

EXPOSE 80
