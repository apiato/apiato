<?php

declare(strict_types=1);

namespace App\Ship\Parents\Providers;

use Apiato\Core\Abstracts\Providers\BroadcastServiceProvider as AbstractBroadcastServiceProvider;
use Illuminate\Support\Facades\Broadcast;

/**
 * Class BroadcastServiceProvider.
 * A.K.A. app/Providers/BroadcastServiceProvider.php.
 */
abstract class BroadcastServiceProvider extends AbstractBroadcastServiceProvider
{
    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Broadcast::routes();

        require app_path('Ship/Broadcasts/channels.php');
    }
}
