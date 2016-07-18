<?php

namespace App\Containers\User\UI\WEB\Controllers;

use App\Port\Controller\Abstracts\PortWebController;

/**
 * Class Controller
 *
 * @author  Mahmoud Zalt  <mahmoud@zalt.me>
 */
class Controller extends PortWebController
{

    /**
     * @return  \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function sayWelcome()
    {
        return view('user-welcome');
    }
}
