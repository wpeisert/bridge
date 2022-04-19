#!/bin/sh

php artisan queue:work --queue=high &
php artisan queue:work &
