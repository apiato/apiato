<?php

namespace App\Port\Event\Providers;

use Illuminate\Foundation\Support\Providers\EventServiceProvider as LaravelServiceProvider;

/**
 * Class MainEventsServiceProvider
 *
 * A.K.A app/Providers/EventsServiceProvider.php
 *
 * @author  Mahmoud Zalt  <mahmoud@zalt.me>
 */
class MainEventsServiceProvider extends LaravelServiceProvider
{

    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        //
    ];


    /**
     * Register any other events for your application.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();

        //
    }

}
