<?php

namespace App\Ship\Providers;

use App\Ship\Parents\Providers\RouteServiceProvider as ParentRouteServiceProvider;

class RouteServiceProvider extends ParentRouteServiceProvider
{
    // Route names
    public const HOME = 'web_welcome_say_welcome';
    public const LOGIN = 'login';
}
