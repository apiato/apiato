<?php

namespace App\Modules\User\Controllers\Web;

use App\Modules\Core\Controller\Abstracts\WebController;

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
