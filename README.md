laravel new to-do-list

php artisan make:model ToDoItem -m

php artisan migrate

composer require tymon/jwt-auth "1.0.*"

php artisan vendor:publish --provider="Tymon\JWTAuth\Providers\LaravelServiceProvider"

php artisan jwt:secret

php artisan make:controller AuthController

php artisan make:resource ToDoItemResource

php artisan make:controller ToDoItemController --api
