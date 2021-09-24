<?php

namespace App\Ship\Parents\Providers;

use Apiato\Core\Abstracts\Providers\BroadcastsProvider as AbstractBroadcastsProvider;
use Illuminate\Support\Facades\Broadcast;
use function app_path;

/**
 * Class BroadcastServiceProvider
 *
 * A.K.A. app/Providers/BroadcastServiceProvider.php
 */
abstract class BroadcastServiceProvider extends AbstractBroadcastsProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Broadcast::routes();

        require app_path('Ship/Broadcasts/Routes.php');
    }
}
