<?php

namespace App\Containers\SocialAuth\Tasks;

use App\Containers\SocialAuth\Extra\SocialProvider;
use App\Ship\Parents\Tasks\Task;
use Laravel\Socialite\Facades\Socialite;
use App\Ship\Parents\Tasks\Task;

/**
 * Class GetUserSocialProfileTask.
 *
 * @author Mahmoud Zalt <mahmoud@zalt.me>
 */
class GetUserSocialProfileTask extends Task
{

    /**
     * @param            $provider
     * @param array|null $requestData
     *
     * @return  null|\App\Containers\User\Models\User
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
