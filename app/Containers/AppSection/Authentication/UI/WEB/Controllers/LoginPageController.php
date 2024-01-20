<?php

namespace App\Containers\AppSection\Authentication\UI\WEB\Controllers;

use App\Ship\Parents\Controllers\WebController;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;

class LoginPageController extends WebController
{
    public function __invoke(): Factory|View|Application
    {
        return view('appSection@authentication::login');
    }
}
