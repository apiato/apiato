<?php

namespace App\Containers\AppSection\Authentication\Providers;

use App\Ship\Parents\Providers\ServiceProvider as ParentServiceProvider;
use Illuminate\Support\Facades\Request;

final class RequestServiceProvider extends ParentServiceProvider
{
    public function boot(): void
    {
        /*
         * Get the App-Identifier header value from the request or use the default app.
         */
        Request::macro('appId', function (): string {
            return $this->header('App-Identifier', config()->string('apiato.defaults.app'));
        });
    }
}
