#!/bin/bash

cd ..
php artisan migrate
php artisan serve -vvv --host 0.0.0.0
