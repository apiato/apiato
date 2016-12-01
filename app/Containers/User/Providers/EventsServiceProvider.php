<?php

namespace App\Containers\User\Providers;

use App\Containers\User\Events\Events\UserCreatedEvent;
use App\Containers\User\Events\Handlers\UserCreatedEventHandler;
use App\Port\Event\Providers\PortEventsServiceProvider;
use Illuminate\Contracts\Events\Dispatcher as DispatcherContract;
use Illuminate\Events\Dispatcher;

/**
 * Class EventsServiceProvider
 *
 * @author  Mahmoud Zalt  <mahmoud@zalt.me>
 */
class EventsServiceProvider extends PortEventsServiceProvider
{

    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        UserCreatedEvent::class => [
            UserCreatedEventHandler::class,
        ],
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
