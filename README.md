# Roles And Permissions (Fix for Laravel 5.3+)
- [Creating Roles](#creating-roles)
- [Attaching And Detaching Roles](#attaching-and-detaching-roles)
- [Checking For Roles](#checking-for-roles)

## How to install

Install via composer
```
composer require selfreliance/fixroles
```

Config, migrations and seed
```php
php artisan vendor:publish --provider="Selfreliance\fixroles\RolesServiceProvider" --tag="config" --force
php artisan vendor:publish --provider="Selfreliance\fixroles\RolesServiceProvider" --tag="migrations" --force
php artisan vendor:publish --provider="Selfreliance\fixroles\RolesServiceProvider" --tag="seed" --force
```

Edit model User (App/User.php)
```php
use Selfreliance\fixroles\Traits\HasRole;
use Selfreliance\fixroles\Contracts\HasRole as HasRoleContract;

class User extends Authenticatable implements HasRole
```

```
in class:
use HasRole;
```

Edit model Kernel (App/Http/Kernel.php)
```
transfer from protected $middlewareGroups to protected $middleware

/*
    \App\Http\Middleware\EncryptCookies::class,
    \Illuminate\Session\Middleware\StartSession::class,
*/

add to $routeMiddleware

/*
    'CheckAccess' => \App\Http\Middleware\CheckAccess::class
*/
```

And do not forget about 
```php 
php artisan migrate
composer dump-autoload -o
php artisan db:seed --class="Selfreliance\fixroles\Seeds\CreateOrAttachAdmin" // create admin role and attach to user (id=1)
```
