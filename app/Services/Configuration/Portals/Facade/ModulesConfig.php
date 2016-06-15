<?php

namespace App\Services\Configuration\Portals\Facade;

use Illuminate\Support\Facades\Facade;

/**
 * Class ModulesConfiguration
 *
 * @author  Mahmoud Zalt  <mahmoud@zalt.me>
 */
class ModulesConfig extends Facade
{

    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'modulesConfigReaderService';
    }

}

