<?php

namespace App\Ship\Parents\Providers;

use Apiato\Core\Abstracts\Providers\MainProvider as AbstractMainProvider;

/**
 * Class MainProvider.
 *
 * @author  Mahmoud Zalt <mahmoud@zalt.me>
 */
abstract class MainProvider extends AbstractMainProvider
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
