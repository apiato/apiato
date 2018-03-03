<?php

namespace App\Containers\SocialAuth\Actions;

use Apiato\Core\Foundation\Facades\Apiato;
use App\Ship\Parents\Actions\Action;
use App\Ship\Transporters\DataTransporter;

/**
 * Class SocialLoginAction.
 *
 * @author Mahmoud Zalt <mahmoud@zalt.me>
 */
class SocialLoginAction extends Action
{

    /**
     * ----- if has social profile
     * --------- [A] update his social profile info
     * ----- if has no social profile
     * --------- [C] create new record
     *
     * @param \App\Ship\Transporters\DataTransporter $data
     *
     * @return  mixed
     * @throws \Dto\Exceptions\InvalidDataTypeException
     */
    public function run(DataTransporter $data)
    {
        // fetch the user data from the support platforms
        $socialUserProfile = Apiato::call('SocialAuth@FindUserSocialProfileTask', [$data->provider, $data->toArray()]);

        // check if the social ID exist on any of our users, and get that user in case it was found
        $socialUser = Apiato::call('SocialAuth@FindSocialUserTask', [$data->provider, $socialUserProfile->id]);

        // checking if some data are available in the response
        // (these lines are written to make this function compatible with multiple providers)
        $tokenSecret = $socialUserProfile->tokenSecret ?? null;
        $expiresIn = $socialUserProfile->expiresIn ?? null;
        $refreshToken = $socialUserProfile->refreshToken ?? null;
        $avatar_original = $socialUserProfile->avatar_original ?? null;

        if ($socialUser) {

            // THIS IS: A USER AND ALREADY HAVE A SOCIAL PROFILE
            // DO: UPDATE THE EXISTING USER SOCIAL PROFILE.

            // Only update tokens and updated information. Never override the user profile.
            $user = Apiato::call('SocialAuth@UpdateUserSocialProfileTask', [
                $socialUser->id,
                $socialUserProfile->token,
                $expiresIn,
                $refreshToken,
                $tokenSecret,
                $socialUserProfile->avatar,
                $avatar_original
            ]);

        } else {
            // THIS IS: A NEW USER
            // DO: CREATE NEW USER FROM THE SOCIAL PROFILE INFORMATION.

            $user = Apiato::call('SocialAuth@CreateUserBySocialProfileTask', [
                $data->provider,
                $socialUserProfile->token,
                $socialUserProfile->id,
                $socialUserProfile->nickname,
                $socialUserProfile->name,
                $socialUserProfile->email,
                $socialUserProfile->avatar,
                $tokenSecret,
                $expiresIn,
                $refreshToken,
                $avatar_original
            ]);
        }

        // Authenticate the user from its object
        $personalAccessTokenResult = Apiato::call('Authentication@ApiLoginFromUserTask', [$user]);

        return [
            'user'  => $user,
            'token' => $personalAccessTokenResult,
        ];
    }

}
