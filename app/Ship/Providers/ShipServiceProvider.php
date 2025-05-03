<?php

namespace App\Ship\Providers;

use App\Ship\Parents\Models\Model;
use App\Ship\Parents\Models\UserModel;
use App\Ship\Parents\Providers\ServiceProvider as ParentServiceProvider;
use Carbon\CarbonImmutable;
use Illuminate\Http\Client\RequestException;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Facades\Request;

final class ShipServiceProvider extends ParentServiceProvider
{
    public function boot(): void
    {
        $this->registerMacros();
        RequestException::dontTruncate();
        Date::use(CarbonImmutable::class);
        Model::shouldBeStrict(!app()->isProduction());
        UserModel::shouldBeStrict(!app()->isProduction());
    }

    public function registerMacros(): void
    {
        /*
         * Get the App-Identifier header value from the request or use the default app.
         */
        Request::macro('appId', function (): string {
            return $this->header('App-Identifier', config()->string('apiato.defaults.app'));
        });
    }
}
