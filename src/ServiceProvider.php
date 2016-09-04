<?php
namespace Neronplex\CakeORMEnabler;

use Cake\Cache\Cache;
use Cake\Core\Configure;
use Cake\Datasource\ConnectionManager;
use Cake\ORM\TableRegistry;
use Cake\Utility\Inflector;
use Illuminate\Support\ServiceProvider as IlluminateServiceProvider;

/**
 * Class ServiceProvider
 *
 * @author    暖簾 (@neronplex) <admin@neronplex.info>
 * @copyright Copyright (c) 2016 暖簾 (@neronplex)
 * @link      https://github.com/neronplex/cake-orm-enabler
 * @license   http://www.apache.org/licenses/LICENSE-2.0 Apache License, Version 2.0
 * @package   Neronplex\CakeORMEnabler
 * @since     0.0.1
 */
class ServiceProvider extends IlluminateServiceProvider
{
    /**
     * Default app namespace.
     *
     * @var string
     */
    const DEFAULT_NAMESPACE = 'App';

    /**
     * Default database connection class name.
     *
     * @var string
     */
    const DEFAULT_CONNECTION_CLASS = 'Cake\Database\Connection';

    /**
     * Default database drivers namespace.
     */
    const DEFAULT_DRIVER_NAMESPACE = 'Cake\Database\Driver\\';

    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = true;

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $this
            ->setupNamespace()
            ->setupConnection()
            ->setupCache();
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton('TableRegistry', function ($app) {
            return new TableRegistry;
        });
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return ['Cake\ORM\TableRegistry'];
    }

    /**
     * Get Cakephp connection class name.
     *
     * @return string
     */
    protected function getConnectionClass()
    {
        return static::DEFAULT_CONNECTION_CLASS;
    }

    /**
     * Get DB driver class name.
     *
     * @return mixed|null|string
     */
    protected function getDriver()
    {
        $driver = Inflector::camelize(env('DB_CONNECTION', 'mysql'));

        return static::DEFAULT_DRIVER_NAMESPACE.$driver;
    }

    /**
     * Get DB host.
     *
     * @return mixed|null|string
     */
    protected function getHost()
    {
        return env('DB_HOST', 'localhost');
    }

    /**
     * Get DB username.
     *
     * @return mixed|null|string
     */
    protected function getUsername()
    {
        return env('DB_USERNAME', 'forge');
    }

    /**
     * Get DB password.
     *
     * @return mixed|null|string
     */
    protected function getPassword()
    {
        return env('DB_PASSWORD', '');
    }

    /**
     * get DB name.
     *
     * @return mixed|null|string
     */
    protected function getDatabase()
    {
        return env('DB_DATABASE', 'forge');
    }

    /**
     * Get encording charset.
     *
     * @return mixed|null|string
     */
    protected function getEncording()
    {
        return env('DB_ENCORDING', 'utf8');
    }

    /**
     * Get DB timezone.
     *
     * @return mixed|null|string
     */
    protected function getTimezone()
    {
        return env('DB_TIMEZONE', 'SYSTEM');
    }

    /**
     * Get cache class name.
     *
     * @return mixed|null|string
     */
    protected function getCacheClass()
    {
        return env('CACHE_CAKEMODEL_CLASS', 'File');
    }

    /**
     * Get cache prefix.
     *
     * @return mixed|null|string
     */
    protected function getCachePrefix()
    {
        return env('CACHE_CAKEMODEL_PREFIX', 'myapp_cake_model_');
    }

    /**
     * Get cache path.
     *
     * @return mixed|null|string
     */
    protected function getCachePath()
    {
        return env('CACHE_CAKEMODEL_PATH', storage_path('framework/cache'));
    }

    /**
     * Get cache duration.
     *
     * @return mixed|null|string
     */
    protected function getCacheDuration()
    {
        return env('CACHE_CAKEMODEL_DURATION', '+2 minutes');
    }

    /**
     * Get cache url.
     *
     * @return mixed|null|string
     */
    protected function getCacheUrl()
    {
        return env('CACHE_CAKEMODEL_URL', null);
    }

    /**
     * Persistent flag.
     *
     * @return mixed|null|string
     */
    protected function isPersistent()
    {
        return env('DB_PERSISTENT', false);
    }

    /**
     * Creating cache flag.
     *
     * @return bool
     */
    protected function isCacheMetadata()
    {
        return (bool) env('DB_CACHE_METADATA', false);
    }

    /**
     * Cache serialize flag.
     *
     * @return bool
     */
    protected function isCacheSerialize()
    {
        return (bool) env('CACHE_CAKEMODEL_SERIALIZE', true);
    }

    /**
     * Set up application namespace.
     *
     * @return self
     */
    protected function setupNamespace()
    {
        Configure::write('App.namespace', static::DEFAULT_NAMESPACE);

        return $this;
    }

    /**
     * Set up database connection
     *
     * @return self
     */
    protected function setupConnection()
    {
        ConnectionManager::config('default', [
            'className'     => $this->getConnectionClass(),
            'driver'        => $this->getDriver(),
            'persistent'    => $this->isPersistent(),
            'host'          => $this->getHost(),
            'username'      => $this->getUsername(),
            'password'      => $this->getPassword(),
            'database'      => $this->getDatabase(),
            'encoding'      => $this->getEncording(),
            'timezone'      => $this->getTimezone(),
            'cacheMetadata' => $this->isCacheMetadata(), // If true, require "cakephp/cache"
        ]);

        return $this;
    }

    /**
     * Set up cache settings
     *
     * @return self
     */
    protected function setupCache()
    {
        if ($this->isCacheMetadata())
        {
            Configure::write('Cache._cake_model_', [
                'className' => $this->getCacheClass(),
                'prefix'    => $this->getCachePrefix(),
                'path'      => $this->getCachePath(),
                'serialize' => $this->isCacheSerialize(),
                'duration'  => $this->getCacheDuration(),
                'url'       => $this->getCacheUrl()
            ]);
            Cache::config(Configure::consume('Cache'));
        }

        return $this;
    }
}
