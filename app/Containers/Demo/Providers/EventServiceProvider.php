<?php

namespace App\Containers\Demo\Providers;

use App\Kernel\Event\Providers\KernelEventServiceProvider;
use Illuminate\Contracts\Events\Dispatcher as DispatcherContract;

/**
 * Class EventServiceProvider
 *
 * @author  Mahmoud Zalt  <mahmoud@zalt.me>
 */
class EventServiceProvider extends KernelEventServiceProvider
{

    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        \App\Containers\Demo\Events\Events\DemoEvent::class => [
            \App\Containers\Demo\Events\Handlers\DemoEventHandler::class,
        ],
    ];

    /**
     * Register any other events for your application.
     *
     * @param  \Illuminate\Contracts\Events\Dispatcher $events
     *
     * @return void
     */
    public function boot(DispatcherContract $events)
    {
        parent::boot($events);

        //
    }
}
