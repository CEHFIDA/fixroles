# Roles And Permissions (Fix for Laravel 5.3+)

## How to install

Install via composer
```
composer require selfreliance/fixroles
```

Config, migrations and seed
```php
php artisan vendor:publish --provider="Selfreliance\fixroles\RolesServiceProvider" --force
php artisan migrate
php artisan db:seed --class="CreateOrAttachAdmin"
```

Edit model User (App/User.php)
```php
use Selfreliance\fixroles\Traits\HasRole;
use Selfreliance\fixroles\Contracts\HasRole as HasRoleContract;

class User extends Authenticatable implements HasRole
{
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
