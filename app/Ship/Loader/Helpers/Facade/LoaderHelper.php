<?php

namespace App\Ship\Loader\Helpers\Facade;

use Illuminate\Support\Facades\Facade;

/**
 * Class LoaderHelper
 *
 * @author  Mahmoud Zalt  <mahmoud@zalt.me>
 */
class LoaderHelper extends Facade
{

    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'LoaderHelper';
    }

}

