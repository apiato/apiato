<?php

namespace App\Ship\Parents\Providers;

use Apiato\Core\Abstracts\Providers\BroadcastsProvider as AbstractBroadcastsProvider;
use Illuminate\Support\Facades\Broadcast;
use function app_path;

/**
 * Class BroadcastsProvider
 *
 * A.K.A app/Providers/BroadcastServiceProvider.php
 *
 * @author  Mahmoud Zalt  <mahmoud@zalt.me>
 */
class BroadcastsProvider extends AbstractBroadcastsProvider
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
