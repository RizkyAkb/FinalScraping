# FinalScraping
 
composer update
php artisan migrate
php artisan db:seed --class=FakultasSeeder
php artisan db:seed --class=ProdiSeeder
php artisan db:seed --class=UserSeeder
