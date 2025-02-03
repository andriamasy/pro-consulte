FROM php:8.1-fpm

RUN apt-get update && apt-get install -y \
    git \
    curl \
    libpng-dev \
    libjpeg-dev \
    libfreetype6-dev \
    libonig-dev \
    libxml2-dev \
    libzip-dev \
    libicu-dev \
    libpq-dev \
    libssl-dev \
    unzip \
    zip

RUN docker-php-ext-install  -j$(nproc) \
    pdo \
    pdo_mysql \
    pdo_pgsql \
    intl \
    exif \
    pcntl \
    bcmath \
    gd \
    zip \
    mbstring \
    soap \
    sockets \
    opcache \
    calendar

COPY php.ini /usr/local/etc/php/conf.d/custom.ini

RUN curl -sS https://getcomposer.org/installer | php -- \
    --install-dir=/usr/local/bin --filename=composer

WORKDIR /var/www/html
RUN chown -R www-data:www-data /var/www/html
USER www-data