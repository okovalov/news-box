php /usr/local/bin/composer install
php /usr/local/bin/composer dump-autoload
php artisan migrate:fresh --seed
#php artisan db:seed --class=StoreProductsTableSeeder
php artisan cache:clear
php artisan config:clear

