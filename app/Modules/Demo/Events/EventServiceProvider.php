<?php

namespace Hello\Modules\Demo\Events;

use Illuminate\Contracts\Events\Dispatcher as DispatcherContract;
use Hello\Modules\Core\Event\Abstracts\EventServiceProvider as CoreEventServiceProvider;

/**
 * Class EventServiceProvider
 *
 * @author  Mahmoud Zalt  <mahmoud@zalt.me>
 */
class EventServiceProvider extends CoreEventServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        'Hello\Events\SomeEvent' => [
            'Hello\Listeners\EventListener',
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
