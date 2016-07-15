<?php

namespace App\Containers\Demo\Controllers;

use App\Port\Controller\Abstracts\PortWebController;

/**
 * Class WebController
 *
 * @author  Mahmoud Zalt  <mahmoud@zalt.me>
 */
class WebController extends PortWebController
{

    /**
     * @return  string
     */
    public function sayWelcome()
    {
        return view('just-welcome');
    }
}
