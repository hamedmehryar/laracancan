#Note: This is a pre-release version ;)
# LaraCanCan
Resource-Based permission system for laravel


## Features
* Resource Permissions
* Permission Inheritance
* Roles
* Custom Permissions


## Installation (Laravel 5.x)
In composer.json:

    "require": {
        "hamedmehryar/laracancan" "0.0.0"
    }

Run:

    composer update

Add the service provider to `config/app.php` under `providers`:

    'providers' => [
        Hamedmehryar\Laracancan\LaracancanServiceProvider::class,
    ]

Create the Migration file:

    php artisan laracancan:migration

Migrate your database:

    php artisan migrate

Add the trait to your user model:

    use Hamedmehryar\Laracancan\Traits\LaracancanUserTriat;
    
    class User extends Model {
    	use LaracancanUserTrait;
    }



## Author

- [Hamed Mehryar](https://github.com/hamedmehryar)

