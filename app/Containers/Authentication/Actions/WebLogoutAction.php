<?php

namespace App\Containers\Authentication\Actions;

use App\Ship\Parents\Actions\Action;
use Illuminate\Support\Facades\Auth;

/**
 * Class WebLogoutAction.
 *
 * @author Mahmoud Zalt <mahmoud@zalt.me>
 */
class WebLogoutAction extends Action
{

    /**
     * @return void
     */
    public function run()
    {
        Auth::logout();
    }
}
