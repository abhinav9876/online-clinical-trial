#!/bin/bash

cd ..
composer install
npm install
php artisan migrate
