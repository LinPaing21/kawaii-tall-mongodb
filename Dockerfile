FROM php:8.3-fpm

# Install system dependencies
RUN apt-get update && apt-get install -y \
    git curl unzip libzip-dev libpng-dev libonig-dev libxml2-dev libssl-dev libicu-dev \
    && docker-php-ext-install zip pdo pdo_mysql  mbstring gd intl

# Install Mongo Extension
RUN pecl install mongodb-1.20.0 \
    && docker-php-ext-enable mongodb

# Install Node.js 22 from NodeSource
RUN curl -fsSL https://deb.nodesource.com/setup_22.x | bash -

RUN apt-get install -y nodejs

# Verify Node and NPM versions (optional, good for debugging)
RUN node -v && npm -v

# Set working directory
WORKDIR /var/www

# Copy existing application directory contents
COPY . .

# Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# # Install application dependencies
# RUN composer install

# # Install JS dependencies
# RUN npm install && npm run dev

# PERMISSIONS
RUN chown -R www-data:www-data /var/www \
    && chmod -R 775 /var/www/storage /var/www/bootstrap/cache

RUN git config --global --add safe.directory /var/www

RUN echo "upload_max_filesize=100M\npost_max_size=100M" > /usr/local/etc/php/conf.d/99-custom.ini

# Create and set permissions for entrypoint script
COPY docker/entrypoint.sh /entrypoint.sh
RUN chmod +x /entrypoint.sh

# Expose port 9000 and start PHP-FPM server
EXPOSE 9000
# Change CMD to use entrypoint script
CMD ["/entrypoint.sh"]
