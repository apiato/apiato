<?php

namespace App\Containers\Welcome\UI\WEB\Controllers;

use App\Ship\Parents\Controllers\WebController;

class Controller extends WebController
{
    public function sayWelcome()
    {
        return view('welcome::welcome-page');
    }
}
