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
     * @param      $provider
     * @param null $request
     *
     * @return  mixed
     */
    public function run($provider, array $requestData = null)
    {

        if ($provider == SocialProvider::FACEBOOK) {
            $user = Socialite::driver($provider)->userFromToken($requestData['access_token']);
        } elseif ($provider == SocialProvider::TWITTER) {
            // TODO: I have not yet submitted this PR to Socialite so the function `userFromTokenAndSecret` does not exist in the package
            $user = Socialite::driver($provider)->userFromTokenAndSecret($requestData['oauth_token'],
                $requestData['oauth_token_secret']);

            dd($user);
        }

        return $user;
    }

}
