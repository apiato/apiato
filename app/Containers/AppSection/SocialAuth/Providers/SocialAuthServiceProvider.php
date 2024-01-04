<?php

namespace App\Containers\AppSection\SocialAuth\Providers;

use Illuminate\Support\ServiceProvider;

final class SocialAuthServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        $this->publishes([
            __DIR__ . '/../Configs/vendor-socialAuth.php' => app_path('Ship/Configs/vendor-socialAuth.php'),
        ]);
    }

    public function register(): void
    {
        $this->mergeConfigFrom(
            __DIR__ . '/../Configs/vendor-socialAuth.php',
            'vendor-socialAuth',
        );
    }
}
