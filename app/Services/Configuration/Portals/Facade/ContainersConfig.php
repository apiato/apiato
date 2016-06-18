<?php

namespace App\Services\Configuration\Portals\Facade;

use Illuminate\Support\Facades\Facade;

/**
 * Class ContainersConfiguration
 *
 * @author  Mahmoud Zalt  <mahmoud@zalt.me>
 */
class ContainersConfig extends Facade
{

    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'containersConfigReaderService';
    }

}

