<?php

namespace App\Ship\Parents\Providers;

use Apiato\Core\Abstracts\Providers\EventServiceProvider as AbstractEventServiceProvider;

/**
 * Class EventServiceProvider
 *
 * A.K.A. app/Providers/EventServiceProvider.php
 */
abstract class EventServiceProvider extends AbstractEventServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array<class-string, array<int, class-string>>
     */
    protected $listen = [];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Determine if events and listeners should be automatically discovered.
     *
     * @return bool
     */
    public function shouldDiscoverEvents()
    {
        return false;
    }
}
