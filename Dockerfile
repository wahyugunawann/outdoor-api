FROM php:8.2-apache

RUN apt-get update && apt-get install -y \
    libzip-dev \
    zip \
    unzip \
    && docker-php-ext-install mysqli

WORKDIR /var/www/html

COPY . .

RUN chown -R www-data:www-data /var/www/html

RUN a2enmod rewrite

EXPOSE 80

CMD ["apache2-foreground"]