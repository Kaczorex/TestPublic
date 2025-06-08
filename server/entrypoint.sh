#!/bin/sh

# Instalacja zależności PHP i JS
composer install
npm install

chmod -R 777 storage bootstrap/cache

# Start Apache w tle
service apache2 start

# Uruchomienie serwera dev Vite / npm na pierwszym planie
npm run dev
