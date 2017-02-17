<?php

namespace App\Containers\Welcome\UI\WEB\Controllers;

use App\Ship\Controller\Abstracts\PortWebController;

/**
 * Class Controller
 *
 * @author  Mahmoud Zalt  <mahmoud@zalt.me>
 */
class Controller extends PortWebController
{

    /**
     * @return  string
     */
    public function sayWelcome()
    {
        return view('just-welcome');
    }
}
