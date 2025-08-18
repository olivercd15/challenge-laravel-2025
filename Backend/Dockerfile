FROM php:8.2-fpm

# Extensions
RUN apt-get update && apt-get install -y \
    libpq-dev \
    zip \
    unzip \
    git \
    curl \
    && docker-php-ext-install pdo pdo_pgsql

# Redis
RUN pecl install redis && docker-php-ext-enable redis

# Composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

WORKDIR /var/www
COPY . .

# Laravel Composer Install
RUN composer install --optimize-autoloader

# Storage and Bootstrap
RUN chown -R www-data:www-data /var/www/storage /var/www/bootstrap/cache
