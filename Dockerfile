FROM php:8.2-fpm

# Install dependencies
RUN apt-get update && apt-get install -y \
    libpng-dev libonig-dev libxml2-dev zip unzip curl git nginx supervisor

# Install PHP extensions
RUN docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd

RUN chown -R www-data:www-data /var/www/storage /var/www/bootstrap/cache

# Copy Laravel project
WORKDIR /var/www
COPY . .

# Install composer
COPY --from=composer:2.6 /usr/bin/composer /usr/bin/composer
RUN composer install --no-dev --optimize-autoloader

# Ensure storage + cache directories exist
RUN mkdir -p /var/www/storage /var/www/bootstrap/cache

# Fix permissions
RUN chown -R www-data:www-data /var/www/storage /var/www/bootstrap/cache

EXPOSE 80

# CMD ["/usr/bin/supervisord", "-n", "-c", "/etc/supervisor/conf.d/supervisord.conf"]
