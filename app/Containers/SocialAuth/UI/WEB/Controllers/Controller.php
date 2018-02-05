<?php

namespace App\Containers\SocialAuth\UI\WEB\Controllers;

use App\Ship\Parents\Controllers\WebController;
use Laravel\Socialite\Facades\Socialite;

/**
 * Class Controller
 *
 * @author  Mahmoud Zalt  <mahmoud@zalt.me>
 */
class Controller extends WebController
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
        return Socialite::driver($provider)->user();
    }

}
