<?php

namespace App\Ship\Providers;

use App\Ship\Parents\Models\Model;
use App\Ship\Parents\Models\UserModel;
use App\Ship\Parents\Providers\ServiceProvider as ParentServiceProvider;
use Carbon\CarbonImmutable;
use Illuminate\Http\Client\RequestException;
use Illuminate\Support\Facades\Date;

class ShipServiceProvider extends ParentServiceProvider
{
    public function boot(): void
    {
        Date::use(CarbonImmutable::class);
        Model::shouldBeStrict(!app()->isProduction());
        UserModel::shouldBeStrict(!app()->isProduction());
        RequestException::dontTruncate();
    }
}
