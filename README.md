# cake-orm-enabler

cake-orm-enabler is a package to enable the [cakephp/orm](https://github.com/cakephp/orm) in Laravel.

## Installing your project

### Install via Composer
```
$ composer require neronplex/cake-orm-enabler:"0.0.1"
```

### Adding Service Provider
In the case of Laravel.
```php
// providers array in config/app.php
Neronplex\CakeORMEnabler\ServiceProvider::class,
```

In the case of Lumen.
```php
// add line in config/app.php
$app->register(Neronplex\CakeORMEnabler\ServiceProvider::class);
```

### Adding Facade
In the case of Laravel.
```php
// aliases array in config/app.php
'TableRegistry' => Neronplex\CakeORMEnabler\Facades\TableRegistry::class,
```

In the case of Lumen.
```php
// add line in config/app.php
class_alias('Neronplex\CakeORMEnabler\Facades\TableRegistry', 'TableRegistry');
```

## Usage
How to use the ORM case refer to the [official reference](http://book.cakephp.org/3.0/en/orm.html).

## License
Copyright &copy; 2016 暖簾 ([@neronplex](http://twitter.com/neronplex))
Licensed under the [Apache License, Version 2.0][Apache]
 [Apache]: http://www.apache.org/licenses/LICENSE-2.0