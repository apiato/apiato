<?php

namespace App\Ship\Parents\Providers;

use Apiato\Core\Abstracts\Providers\RouteServiceProvider as AbstractRouteServiceProvider;

/**
 * Class RouteServiceProvider.
 * A.K.A. app/Providers/RouteServiceProvider.php.
 */
abstract class RouteServiceProvider extends AbstractRouteServiceProvider
{
    public function boot(): void
    {
        $this->configureRateLimiting();

        parent::boot();
    }

    /**
     * Configure the rate limiters for the application.
     */
    protected function configureRateLimiting(): void
    {
    }
}
