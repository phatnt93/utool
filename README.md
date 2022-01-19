# UTool

## About UTool

Project based on laravel 8

## How to backup menu
- B1: Run command "php artisan seed_menu"
- END

## How to start
- B1: composer install | composer update
- B2: chown nginx:nginx -R [source]
- B3: php artisan key:generate
- B4: Run migrate "php artisan migrate" to create table in db
- B5: Run command "php artisan db:seed --class=DatabaseSeeder" to insert data into db
- END

## Declare and use permission
- Declare list permission at "app/Models/Permission.php"
- Write admin_acc_can, web_acc_can or api_acc_can function in Action function
Ex: 
public function create(Request $request){
    // admin_acc_can('admin.user.create');


