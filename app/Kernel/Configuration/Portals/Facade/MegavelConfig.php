<?php

namespace App\Kernel\Configuration\Portals\Facade;

use Illuminate\Support\Facades\Facade;

/**
 * Class MegavelConfiguration
 *
 * @author  Mahmoud Zalt  <mahmoud@zalt.me>
 */
class MegavelConfig extends Facade
{

    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'megavelConfigReaderService';
    }

}

