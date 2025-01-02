# Use PHP 8.2 FPM base image
FROM php:8.2-fpm

# Install system dependencies, including Nginx, curl, FFmpeg, and PHP extensions
RUN apt-get update && apt-get install -y \
    libpng-dev \
    libjpeg-dev \
    libfreetype6-dev \
    zip \
    git \
    curl \
    nginx \
    ffmpeg \
    && apt-get clean

# Install PHP extensions required for Laravel
RUN docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install gd pdo pdo_mysql

# Install Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Set working directory
WORKDIR /var/www/html

# Copy application code into container
COPY . /var/www/html

# Install Laravel's PHP dependencies using Composer
RUN composer install --no-dev --optimize-autoloader

# Copy Nginx configuration
COPY ./docker/nginx/default.conf /etc/nginx/sites-available/default

# Expose HTTP port
EXPOSE 80

# Start Nginx and PHP-FPM
CMD service nginx start && php-fpm
