#!/bin/sh
set -e

echo "Waiting for MySQL (db:3306) to be ready..."
until nc -z db 3306; do
  sleep 1
  echo "Waiting for MySQL..."
done

echo "MySQL is up, proceeding with composer install if needed..."

if [ ! -d vendor ] || [ -z "$(ls -A vendor)" ]; then
  composer install --no-dev --optimize-autoloader
fi

php artisan migrate --force

exec "$@"
