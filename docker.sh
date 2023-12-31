#!/bin/bash
cp .env.example .env
docker-compose up -d
docker-compose exec app composer update --no-scripts
docker-compose exec app composer dump-autoload
docker-compose exec app php artisan key:generate
docker-compose exec app php artisan config:cache
docker-compose exec app composer install
docker-compose exec app php artisan migrate
code=$(curl -s -o /dev/null -w "%{http_code}" 0.0.0.0)
if [[ "$code" = 200 ]]; then
    echo "Complete. Web site is start"
    echo "Install node_modules"
    sleep(3)
else
    echo "Error. Please contact 0963374343!"
fi
npm install
npm run watch

code=$(curl -s -o /dev/null -w "%{http_code}" 0.0.0.0/login)
if [[ "$code" = 200 ]]; then
    echo "Complete. Web site is runing on "
    echo ">>>>> http://127.0.0.1 <<<<"
else
    echo "Error. Please contact 0963374343!"
fi
