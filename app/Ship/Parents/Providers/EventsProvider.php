<?php

namespace App\Ship\Parents\Providers;

use Illuminate\Foundation\Support\Providers\EventServiceProvider as LaravelEventServiceProvider;

/**
 * Class EventsProvider
 *
 * A.K.A app/Providers/EventsServiceProvider.php
 *
 * @author  Mahmoud Zalt  <mahmoud@zalt.me>
 */
class EventsProvider extends LaravelEventServiceProvider
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
