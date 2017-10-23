# Roles And Permissions (Fix for Laravel 5.3+)

- [Usage](#usage)
    - [Creating Role](#creating-role)
    - [Attaching And Detaching Role](#attaching-and-detaching-role)
    - [Checking For Role](#checking-for-role)
    - [Blade Extensions](#blade-extensions)

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

class User extends Authenticatable implements HasRoleContract
{
	use HasRole;
	protected $fillable = [
		'role_id',
		//
	]
	//
}
```

Edit model Kernel (App/Http/Kernel.php)

Transfer from protected $middlewareGroups to protected $middleware

```
\App\Http\Middleware\EncryptCookies::class,
\Illuminate\Session\Middleware\StartSession::class,
```

Add to $routeMiddleware

```
'CheckAccess' => \App\Http\Middleware\CheckAccess::class
```

## Usage

### Creating Role

```php
use Selfreliance\fixroles\Models\Role;

$accessible = array(
    config('adminamazing.path'),
    "adminrole",
    "adminmenu"
);

$adminRole = Role::create([
    'name' => 'Admin',
    'slug' => 'admin',
    'accessible_pages' => json_encode($accessible)
]);
```

> Because of `Slugable` trait, if you make a mistake and for example leave a space in slug parameter, it'll be replaced with a dot automatically, because of `str_slug` function.

### Attaching and Detaching Role

```php
use App\User;

$user = User::find($id);

$user->attachRole($adminRole->id); // you can pass id, name or slug
```

```php
$user->detachRole($adminRole->id); // you can pass id, name or slug
```

### Checking For Role

if($user->hasRole($adminRole->id)) // you can pass id, name or slug
{
	//
}

### Blade Extensions

There are four Blade extensions. Basically, it is replacement for classic if statements.

```php
@checkrole('checkrole', 'admin') // @if(Auth::check() && Auth::user()->checkRole($prefix))
    // user role has the specified prefix => admin
@endcheck