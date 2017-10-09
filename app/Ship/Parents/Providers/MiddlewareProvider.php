<?php

namespace App\Ship\Parents\Providers;

use Apiato\Core\Abstracts\Providers\MiddlewareProvider as AbstractMiddlewareProvider;

/**
 * Class MiddlewareProvider
 *
 * @author  Mahmoud Zalt  <mahmoud@zalt.me>
 */
abstract class MiddlewareProvider extends AbstractMiddlewareProvider
{

    /**
     * Perform post-registration booting of services.
     */
    public function boot()
    {
        parent::boot();
    }

    /**
     * Register anything in the container.
     */
    public function register()
    {
        parent::register();
    }

}
