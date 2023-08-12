<?php

namespace App\Ship\Providers;

use App\Ship\Parents\Providers\EventServiceProvider as ParentEventServiceProvider;

class EventServiceProvider extends ParentEventServiceProvider
{
    protected $listen = [];
}
