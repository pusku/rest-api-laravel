#!/bin/sh
set -e

/usr/bin/supervisord &
php-fpm

# Run scheduler
# while [ true ]
# do
#   php artisan schedule:run --verbose --no-interaction
#   sleep 60
# done
# * * * * * php /path-to-your-project/artisan schedule:run >> /dev/null 2>&1
