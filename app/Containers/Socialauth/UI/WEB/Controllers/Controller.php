<?php

namespace App\Containers\SocialAuth\UI\WEB\Controllers;

use App\Port\Controller\Abstracts\PortWebController;
use Laravel\Socialite\Facades\Socialite;

/**
 * Class Controller
 *
 * @author  Mahmoud Zalt  <mahmoud@zalt.me>
 */
class Controller extends PortWebController
{

    /**
     * @param $provider
     *
     * @return  mixed
     */
    public function redirectAll($provider)
    {
        return Socialite::driver($provider)->redirect();
    }

    /**
     * @param $provider
     *
     * @return  mixed
     */
    public function handleCallbackAll($provider)
    {
        $user = Socialite::driver($provider)->user();

        // TODO: to be continue.. (move the codes to action), add business logic (store/update User)..

        dd($user);
    }

}
