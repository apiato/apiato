<?php

namespace App\Port\Butler\Portals\Facade;

use Illuminate\Support\Facades\Facade;

/**
 * Class PortButler
 *
 * @author  Mahmoud Zalt  <mahmoud@zalt.me>
 */
class PortButler extends Facade
{

    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'PortButler';
    }

}

