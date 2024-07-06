<?php

namespace App\Ship\Parents\Providers;

use Apiato\Core\Abstracts\Providers\MainServiceProvider as AbstractMainServiceProvider;

/**
 * Class MainServiceProvider.
 * A.K.A. app/Providers/AppServiceProvider.php.
 */
abstract class MainServiceProvider extends AbstractMainServiceProvider
{
    /**
     * Perform post-registration booting of services.
     */
    public function boot(): void
    {
        parent::boot();
        \Laravel\Passport\Passport::enablePasswordGrant();
    }

    /**
     * Register anything in the container.
     */
    public function register(): void
    {
        parent::register();
    }
}
