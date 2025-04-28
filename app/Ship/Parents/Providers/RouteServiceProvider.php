<?php

declare(strict_types=1);

namespace App\Ship\Parents\Providers;

use Apiato\Core\Abstracts\Providers\RouteServiceProvider as AbstractRouteServiceProvider;

/**
 * Class RouteServiceProvider.
 * A.K.A. app/Providers/RouteServiceProvider.php.
 */
abstract class RouteServiceProvider extends AbstractRouteServiceProvider
{
    #[\Override]
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
