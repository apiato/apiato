<?php

namespace App\Containers\User\Controllers\Web;

use App\Engine\Controller\Abstracts\WebController;

/**
 * Class WelcomeUserController
 *
 * @author  Mahmoud Zalt  <mahmoud@zalt.me>
 */
class WelcomeUserController extends WebController
{
    /**
     * @return  string
     */
    public function handle()
    {
        return view('user-welcome');
    }
}
