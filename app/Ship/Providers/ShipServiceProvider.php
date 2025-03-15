<?php

namespace App\Ship\Providers;

use App\Ship\Parents\Models\Model;
use App\Ship\Parents\Models\UserModel;
use App\Ship\Parents\Providers\ServiceProvider as ParentServiceProvider;
use Illuminate\Http\Client\RequestException;

class ShipServiceProvider extends ParentServiceProvider
{
    public function boot(): void
    {
        Model::shouldBeStrict();
        UserModel::shouldBeStrict();
        RequestException::dontTruncate();
    }
}
