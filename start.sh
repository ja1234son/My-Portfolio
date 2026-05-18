#!/usr/bin/env bash

echo "=== Starting deployment ==="

# Fix: Make sure we're in the right directory
cd /var/www/html

echo "Current directory: $(pwd)"

# Install composer dependencies
echo "=== Installing Composer dependencies ==="
composer install --no-dev --optimize-autoloader --no-interaction

# Check if vendor folder exists
if [ -d "vendor" ]; then
    echo "✅ vendor folder exists"
else
    echo "❌ vendor folder missing - composer install failed"
    exit 1
fi

# Create storage and bootstrap cache folders if missing
echo "=== Setting up folders ==="
mkdir -p storage/framework/sessions
mkdir -p storage/framework/views
mkdir -p storage/framework/cache
mkdir -p bootstrap/cache

# Set permissions
echo "=== Setting permissions ==="
chown -R www-data:www-data storage bootstrap/cache
chmod -R 775 storage bootstrap/cache

# Laravel optimizations
echo "=== Caching configuration ==="
php artisan config:cache --no-interaction || true
php artisan route:cache --no-interaction || true
php artisan view:cache --no-interaction || true

echo "=== Starting PHP-FPM and Nginx ==="
# Start PHP-FPM
service php8.2-fpm start

# Start Nginx in foreground
nginx -g "daemon off;"