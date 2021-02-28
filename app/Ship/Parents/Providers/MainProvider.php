<?php

namespace App\Ship\Parents\Providers;

use Apiato\Core\Abstracts\Providers\MainProvider as AbstractMainProvider;

abstract class MainProvider extends AbstractMainProvider
{
    /**
     * Perform post-registration booting of services.
     */
    public function boot(): void
    {
        parent::boot();
    }

    /**
     * Register anything in the container.
     */
    public function register(): void
    {
        parent::register();
    }
}
