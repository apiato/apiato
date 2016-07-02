<?php

namespace App\Kernel\Butler\Portals\Facade;

use Illuminate\Support\Facades\Facade;

/**
 * Class KernelButler
 *
 * @author  Mahmoud Zalt  <mahmoud@zalt.me>
 */
class KernelButler extends Facade
{

    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'KernelButler';
    }

}

