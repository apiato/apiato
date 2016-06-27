<?php

namespace App\Containers\Demo\Events\Handlers;


use App\Containers\Demo\Events\Events\DemoEvent;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class DemoEventHandler
{
    /**
     * Create the event handler.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param \App\Containers\Demo\Events\Events\DemoEvent $event
     *
     * @return void
     */
    public function handle(DemoEvent $event)
    {
        dump('Did you called me!');
    }
}
