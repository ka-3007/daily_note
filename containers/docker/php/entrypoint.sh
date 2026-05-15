#!/bin/sh
chown -R www-data:www-data /var/www/src/storage /var/www/src/bootstrap/cache
chmod -R 775 /var/www/src/storage /var/www/src/bootstrap/cache
exec "$@"
