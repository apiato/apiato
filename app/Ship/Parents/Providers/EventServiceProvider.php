<?php

namespace App\Ship\Parents\Providers;

use Apiato\Core\Abstracts\Providers\EventsProvider as AbstractEventsProvider;

/**
 * Class EventServiceProvider
 *
 * A.K.A. app/Providers/EventServiceProvider.php
 */
abstract class EventServiceProvider extends AbstractEventsProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [];
}
