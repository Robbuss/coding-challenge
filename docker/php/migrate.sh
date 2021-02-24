#!/bin/bash
set -e
cd /var/www
if [ -f .env ]; then
    source .env
fi

echo Start migration
php artisan migrate --force
php artisan migrate --force
php artisan migrate:status
echo All migrations completed
sleep 100000000
