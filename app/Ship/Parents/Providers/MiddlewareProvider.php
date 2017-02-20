<?php

namespace App\Ship\Parents\Providers;

use App\Ship\Engine\Loaders\MiddlewaresLoaderTrait;

/**
 * Class MiddlewareProvider
 *
 * @author  Mahmoud Zalt  <mahmoud@zalt.me>
 */
abstract class MiddlewareProvider extends MainProvider
{

    use MiddlewaresLoaderTrait;

    /**
     * Perform post-registration booting of services.
     */
    public function boot()
    {
        $this->loadContainersInternalMiddlewares();
    }

    /**
     * Register anything in the container.
     */
    public function register()
    {

    }
}
