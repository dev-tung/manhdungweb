FROM php:8.2-apache

RUN a2enmod rewrite

RUN sed -ri -e 's!/var/www/html!/var/www/html/public!g' \
    /etc/apache2/sites-available/*.conf

RUN sed -ri -e 's!/var/www/!/var/www/html/public/!g' \
    /etc/apache2/apache2.conf

WORKDIR /var/www/html