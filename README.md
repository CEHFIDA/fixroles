# Roles And Permissions (Fix for Laravel 5.3+)
- [Creating Roles](#creating-roles)
- [Attaching And Detaching Roles](#attaching-and-detaching-roles)
- [Checking For Roles](#checking-for-roles)

## How to install

Install via composer
```
composer require selfreliance/fixroles
```

Config and migrations
```php
php artisan vendor:publish --provider="Selfreliance\Fixroles\RolesServiceProvider" --tag=config
php artisan vendor:publish --provider="Selfreliance\Fixroles\RolesServiceProvider" --tag=migrations
```
And do not forget about 
```php 
php artisan migrate 
```

## Usage

### Creating Roles

```php
use Selfreliance\Fixroles\Models\Role;

$adminRole = Role::create([
    'name' => 'Admin',
    'slug' => 'admin',
    'description' => '', // optional
    'level' => 1, // optional, set to 1 by default
]);

$moderatorRole = Role::create([
    'name' => 'Forum Moderator',
    'slug' => 'forum.moderator',
]);
```

> Because of `Slugable` trait, if you make a mistake and for example leave a space in slug parameter, it'll be replaced with a dot automatically, because of `str_slug` function.

### Attaching And Detaching Roles

It's really simple. You fetch a user from database and call `attachRole` method. There is `BelongsToMany` relationship between `User` and `Role` model.

```php
use App\User;

$user = User::find($id);

$user->attachRole($adminRole); // you can pass whole object, or just an id
```

```php
$user->detachRole($adminRole); // in case you want to detach role
$user->detachAllRoles(); // in case you want to detach all roles
```

### Checking For Roles

You can now check if the user has required role.

```php
if ($user->is('admin')) { // you can pass an id or slug
    // or alternatively $user->hasRole('admin')
}
```

You can also do this:

```php
if ($user->isAdmin()) {
    //
}
```

And of course, there is a way to check for multiple roles:

```php
if ($user->is('admin|moderator')) { 
    /*
    | Or alternatively:
    | $user->is('admin, moderator'), $user->is(['admin', 'moderator']),
    | $user->isOne('admin|moderator'), $user->isOne('admin, moderator'), $user->isOne(['admin', 'moderator'])
    */

    // if user has at least one role
}

if ($user->is('admin|moderator', true)) {
    /*
    | Or alternatively:
    | $user->is('admin, moderator', true), $user->is(['admin', 'moderator'], true),
    | $user->isAll('admin|moderator'), $user->isAll('admin, moderator'), $user->isAll(['admin', 'moderator'])
    */

    // if user has all roles
}
```
