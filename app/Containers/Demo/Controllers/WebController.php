<?php

namespace App\Containers\Demo\Controllers;

use App\Kernel\Controller\Abstracts\KernelWebController;

/**
 * Class WebController
 *
 * @author  Mahmoud Zalt  <mahmoud@zalt.me>
 */
class WebController extends KernelWebController
{

    /**
     * @return  string
     */
    public function sayWelcome()
    {
        return view('welcome');
    }
}
