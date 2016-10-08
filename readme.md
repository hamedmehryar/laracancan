![Screen Shot](https://raw.github.com/hamedmehryar/laracancan/master/src/public/img/logo.png)

# LaraCanCan
Resource-Based permission system for laravel


## Features
* Resource Permissions
* Permission Inheritance
* Roles
* Custom Permissions

![Screen Shot](https://raw.github.com/hamedmehryar/laracancan/master/roles.png)

![Screen Shot](https://raw.github.com/hamedmehryar/laracancan/master/resources.png)

![Screen Shot](https://raw.github.com/hamedmehryar/laracancan/master/permissions.png)

## Installation (Laravel 5.x)
In composer.json:

    "require": {
        "hamedmehryar/laracancan" "1.0.0"
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

Seed the Permissions:

    php artisan laracancan:seed

Add the trait to your user model:

    use Hamedmehryar\Laracancan\Traits\LaracancanUserTriat;
    
    class User extends Model {
    	use LaracancanUserTrait;
    }


##usage

Permission checking:

    Laracancan::canCreate('<resource-name>');
    Laracancan::canRead('<resource-name>');
    Laracancan::canUpdate('<resource-name>');
    Laracancan::canDelete('<resource-name>');
    Laracancan::can('<permission-name>', '<resource-name>');

    $user->canCreate('<resource-name>');
    $user->canRead('<resource-name>');
    $user->canUpdate('<resource-name>');
    $user->canDelete('<resource-name>');
    $user->can('<permission-name>', '<resource-name>');

Role checking:

    Laracancan::roles();
    Laracancan::hasRole();

    $user->roles();
    $user->hasRole();

Getting Resources based on Permission:

    Laracancan::creatableResources();
    Laracancan::readableResources();
    Laracancan::updatableResources();
    Laracancan::deletableResources();
    Laracancan::resourcesByPermission('<permission-name');

    $user->creatableResources();
    $user->readableResources();
    $user->updatableResources();
    $user->deletableResources();
    $user->resourcesByPermission('<permission-name');

Attaching Roles to user:

    $user->attachRole('<role-object>');
    $user->detachRole('<role-object>');

    $user->attachRoles('<roles>');
    $user->detachRoles('<roles>');


## Author

- [Hamed Mehryar](https://github.com/hamedmehryar)

