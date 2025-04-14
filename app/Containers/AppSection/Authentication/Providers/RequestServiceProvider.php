<?php

namespace App\Containers\AppSection\Authentication\Providers;

use App\Ship\Apps\AppFactory;
use App\Ship\Apps\App;
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

        /*
         * Get the app object from the request.
         *
         * The app object contains all the information about the app, like its name, URL, etc.
         * The app object is used to generate URLs for the app,
         * like password reset links, email verification links, etc.
         */
        Request::macro('app', function (): App {
            return AppFactory::create($this->appId());
        });
    }
}
