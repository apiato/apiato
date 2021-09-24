<?php

namespace App\Ship\Parents\Providers;

use Apiato\Core\Abstracts\Providers\EventServiceProvider as AbstractEventServiceProvider;

/**
 * Class EventServiceProvider
 *
 * A.K.A. app/Providers/EventServiceProvider.php
 */
abstract class EventServiceProvider extends AbstractEventServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [];
}
