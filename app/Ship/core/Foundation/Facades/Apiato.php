<?php

namespace Apiato\Core\Foundation\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * Class Apiato
 *
 * @author  Mahmoud Zalt  <mahmoud@zalt.me>
 */
class Apiato extends Facade
{

    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'Apiato';
    }

}

