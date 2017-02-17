<?php

namespace App\Ship\Foundation\Shipals\Facade;

use Illuminate\Support\Facades\Facade;

/**
 * Class ShipButler
 *
 * @author  Mahmoud Zalt  <mahmoud@zalt.me>
 */
class ShipButler extends Facade
{

    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'ShipButler';
    }

}

