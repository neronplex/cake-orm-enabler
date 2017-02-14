# cake-orm-enabler

cake-orm-enabler is a package to enable the [cakephp/orm](https://github.com/cakephp/orm) in Laravel.

## Requirements
- [Laravel](https://laravel.com/) or [Lumen](http://lumen.laravel.com/) 5.0.x or later.
- [CakePHP ORM](https://github.com/cakephp/orm) 5.3.x or later.

## Installing your project

### Install via Composer
```
$ composer require neronplex/cake-orm-enabler
```

### Adding Service Provider
In the case of Laravel.
```php
// providers array in config/app.php
Neronplex\CakeORMEnabler\ServiceProvider::class,
```

In the case of Lumen.
```php
// add line in bootstrap/app.php
$app->register(Neronplex\CakeORMEnabler\ServiceProvider::class);
```

### Adding Facade
In the case of Laravel.
```php
// aliases array in config/app.php
'aliases' => [
    // other facades...
    'TableRegistry' => Neronplex\CakeORMEnabler\Facades\TableRegistry::class,
],
```

In the case of Lumen.
```php
// add line in bootstrap/app.php (5.2 or earlier)
if (!class_exists('TableRegistry'))
{
    class_alias('Neronplex\CakeORMEnabler\Facades\TableRegistry', 'TableRegistry');
}
  
// add line in bootstrap/app.php (5.3 or later)
$app->withFacades(TRUE, [
    // other facades...
    'Neronplex\CakeORMEnabler\Facades\TableRegistry' => 'TableRegistry',
]);
```

## Usage
How to use the ORM case refer to the [official reference](http://book.cakephp.org/3.0/en/orm.html).

## License
Copyright &copy; 2016 暖簾 ([@neronplex](http://twitter.com/neronplex))
Licensed under the [Apache License, Version 2.0][Apache]
 [Apache]: http://www.apache.org/licenses/LICENSE-2.0