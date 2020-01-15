<?php

namespace Apiato\Core\Abstracts\Events\Providers;

use Apiato\Core\Abstracts\Events\Dispatcher\Dispatcher;
use Illuminate\Contracts\Queue\Factory as QueueFactoryContract;

/**
 * Created by PhpStorm.
 * User: arthur
 * Date: 08/11/17
 * Time: 16:20
 */
class EventServiceProvider extends \Illuminate\Events\EventServiceProvider
{
    public function register()
    {
        $this->app->singleton('events', function ($app) {
            return (new Dispatcher($app))->setQueueResolver(function () use ($app) {
                return $app->make(QueueFactoryContract::class);
            });
        });
    }

}
