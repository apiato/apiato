<?php

namespace App\Containers\SocialAuth\Tasks;

use App\Containers\SocialAuth\Exceptions\MissingTokenException;
use App\Containers\SocialAuth\Extra\SocialProvider;
use Laravel\Socialite\Facades\Socialite;

/**
 * Class GetUserSocialProfileTask.
 *
 * @author Mahmoud Zalt <mahmoud@zalt.me>
 */
class GetUserSocialProfileTask
{

    /**
     * @param            $provider
     * @param array|null $requestData
     *
     * @return  null
     */
    public function run($provider, array $requestData = null)
    {
        $user = null;

        if ($provider == SocialProvider::FACEBOOK) {
            $user = Socialite::driver($provider)->userFromToken($requestData['access_token']);
        } elseif ($provider == SocialProvider::TWITTER) {
            $user = Socialite::driver($provider)->userFromTokenAndSecret($requestData['oauth_token'],
                $requestData['oauth_token_secret']);
        }

        return $user;
    }

}
