#!/bin/bash

cd /var/www

# Install PHP dependencies
composer install

# Install NPM dependencies and build assets
npm install
npm run dev &

# Start PHP-FPM
php-fpm
