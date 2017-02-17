<?php

namespace App\Containers\User\UI\WEB\Controllers;

use App\Ship\Controller\Abstracts\ShipWebController;

/**
 * Class Controller
 *
 * @author  Mahmoud Zalt  <mahmoud@zalt.me>
 */
class Controller extends ShipWebController
{

    /**
     * @return  \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function sayWelcome()
    {
        return view('user-welcome');
    }
}
