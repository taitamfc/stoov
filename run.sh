export LC_CTYPE=en_US.UTF-8
export LC_ALL=en_US.UTF-8

git pull origin develop --rebase

php artisan migrate --path=database/migrations/batch10/

composer dump
composer install

chmod -R 777 bootstrap/ storage/ .env

php artisan config:cache && php artisan config:clear && php artisan view:clear && php artisan route:clear
