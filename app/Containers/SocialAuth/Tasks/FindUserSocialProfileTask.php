<?php

namespace App\Containers\SocialAuth\Tasks;

use App\Containers\SocialAuth\Exceptions\UnsupportedSocialAuthProviderException;
use App\Ship\Parents\Tasks\Task;
use Laravel\Socialite\Facades\Socialite;

/**
 * Class FindUserSocialProfileTask.
 *
 * @author Mahmoud Zalt <mahmoud@zalt.me>
 */
class FindUserSocialProfileTask extends Task
{

    /**
     * @param            $provider
     * @param array|null $requestData
     *
     * @return  mixed
     * @throws  UnsupportedSocialAuthProviderException
     */
    public function run($provider, array $requestData = null)
    {
        switch ($provider) {
            case 'facebook':
                $user = Socialite::driver($provider)->userFromToken($requestData['oauth_token']);
                break;
            case 'twitter':
                $user = Socialite::driver($provider)->userFromTokenAndSecret($requestData['oauth_token'],
                    $requestData['oauth_secret']);
                break;
            case 'add-your-provider-here':
                $user = null;
                // ....
                break;
            default:
                throw new UnsupportedSocialAuthProviderException("The Social Auth Provider $provider is unsupported.");
        }

        return $user;
    }

}
