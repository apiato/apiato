<?php

namespace App\Containers\Welcome\UI\WEB\Controllers;

use App\Ship\Controller\Abstracts\ShipWebController;

/**
 * Class Controller
 *
 * @author  Mahmoud Zalt  <mahmoud@zalt.me>
 */
class Controller extends ShipWebController
{

    /**
     * @return  string
     */
    public function sayWelcome()
    {
        return view('just-welcome');
    }
}
