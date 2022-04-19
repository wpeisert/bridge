#!/bin/sh

php artisan queue:restart

php artisan queue:work --queue=slow &
php artisan queue:work &
