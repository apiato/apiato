<?php

namespace App\Ship\Providers;

use App\Ship\Parents\Providers\ServiceProvider as ParentServiceProvider;
use Illuminate\Http\Client\RequestException;

class ShipServiceProvider extends ParentServiceProvider
{
    public function boot(): void
    {
        RequestException::dontTruncate();
    }
}
