# Use PHP 8.2 FPM base image
FROM php:8.2-fpm

# Install system dependencies, including curl, FFmpeg, and PHP extensions
RUN apt-get update && apt-get install -y \
    libpng-dev \
    libjpeg-dev \
    libfreetype6-dev \
    zip \
    git \
    curl \
    ffmpeg \
    nginx \
    supervisor \
    && apt-get clean

# Configure and install PHP extensions required for Laravel
RUN docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install gd pdo pdo_mysql

# Install Composer globally
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Set the working directory
WORKDIR /var/www/html

# Copy application code into container
COPY . /var/www/html

# Install Laravel's PHP dependencies using Composer
RUN composer install --no-dev --optimize-autoloader

# Set appropriate permissions for Laravel directories
RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache \
    && chmod -R 775 /var/www/html/storage /var/www/html/bootstrap/cache

# Copy Nginx configuration
COPY ./docker/nginx/default.conf /etc/nginx/sites-available/default

# Remove the existing symbolic link and create a new one
RUN rm -f /etc/nginx/sites-enabled/default && \
    ln -s /etc/nginx/sites-available/default /etc/nginx/sites-enabled/default

# Copy supervisor configuration to manage both Nginx and PHP-FPM
COPY ./docker/supervisord.conf /etc/supervisor/conf.d/supervisord.conf

# Expose HTTP port
EXPOSE 80

# Define entrypoint to run supervisor, which will start both Nginx and PHP-FPM
CMD ["/usr/bin/supervisord"]
