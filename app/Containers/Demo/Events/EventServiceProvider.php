<?php

namespace App\Containers\Demo\Events;

use Illuminate\Contracts\Events\Dispatcher as DispatcherContract;
use App\Kernel\Event\Abstracts\EventServiceProvider as KernelEventServiceProvider;

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
        'App\Events\SomeEvent' => [
            'App\Listeners\EventListener',
        ],
    ];

    /**
     * Register any other events for your application.
     *
     * @param  \Illuminate\Contracts\Events\Dispatcher  $events
     * @return void
     */
    public function boot(DispatcherContract $events)
    {
        parent::boot($events);

        //
    }
}
