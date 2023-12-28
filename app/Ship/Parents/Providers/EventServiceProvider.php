<?php

namespace App\Ship\Parents\Providers;

use Apiato\Core\Abstracts\Providers\EventServiceProvider as AbstractEventServiceProvider;

/**
 * Class EventServiceProvider.
 * A.K.A. app/Providers/EventServiceProvider.php.
 */
abstract class EventServiceProvider extends AbstractEventServiceProvider
{
    /**
     * The event listener mappings for the application.
     */
    protected $listen = [];

    /**
     * Register any other events for your application.
     */
    public function boot(): void
    {
    }

    /**
     * Determine if events and listeners should be automatically discovered.
     */
    public function shouldDiscoverEvents(): bool
    {
        return false;
    }
}
