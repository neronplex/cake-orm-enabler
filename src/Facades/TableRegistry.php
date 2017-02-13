<?php
namespace Neronplex\CakeORMEnabler\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * Class TableRegistry
 *
 * @author    暖簾 (@neronplex) <admin@neronplex.info>
 * @copyright Copyright (c) 2016 暖簾 (@neronplex)
 * @link      https://github.com/neronplex/cake-orm-enabler
 * @license   http://www.apache.org/licenses/LICENSE-2.0 Apache License, Version 2.0
 * @package   Neronplex\CakeORMEnabler\Facades
 * @since     0.0.1
 */
class TableRegistry extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'Cake\ORM\TableRegistry';
    }
}