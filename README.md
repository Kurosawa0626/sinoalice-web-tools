# Initialize
docker-compose up -d  
composer install  
php artisan storage:link  
php artisan migrate
