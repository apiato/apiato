<?php

namespace App\Containers\SocialAuthentication\Tasks;

use App\Containers\SocialAuthentication\Exceptions\MissingTokenException;
use Laravel\Socialite\Facades\Socialite;

/**
 * Class GetUserSocialProfileTask.
 *
 * @author Mahmoud Zalt <mahmoud@zalt.me>
 */
class GetUserSocialProfileTask
{

    /**
     * @param $provider
     *
     * @return  mixed
     */
    public function run($provider)
    {
        // This function will read the `Code` or the `oauth_token` variable from the
        // request to make a call and get the user data.
        $user = Socialite::driver($provider)->user();

        return $user;
    }

}
