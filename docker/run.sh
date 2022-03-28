#!/bin/sh

cd /var/www

composer install

php artisan migrate --force

/usr/bin/supervisord -c /etc/supervisord.conf --silent
