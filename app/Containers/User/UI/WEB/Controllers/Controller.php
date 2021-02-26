<?php

namespace App\Containers\User\UI\WEB\Controllers;

use App\Ship\Parents\Controllers\WebController;
use Illuminate\Contracts\View\Factory;
use Illuminate\View\View;

/**
 * Class Controller
 *
 * @author  Mahmoud Zalt  <mahmoud@zalt.me>
 */
class Controller extends WebController
{

    /**
     * @return  Factory|View
     */
    public function sayWelcome()
    {   // user say welcome
        return view('user::user-welcome');
    }
}
