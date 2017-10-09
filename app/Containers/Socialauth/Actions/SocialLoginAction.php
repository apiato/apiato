<?php

namespace App\Containers\SocialAuth\Actions;

use App\Ship\Parents\Actions\Action;
use Apiato\Core\Foundation\Facades\Apiato;

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
     * @param $request
     * @param $provider
     *
     * @return  mixed
     */
    public function run($request, $provider)
    {
        // TODO: needs refactoring so bad :D

        // fetch the user data from facebook
        $socialUserProfile = Apiato::call('SocialAuth@FindUserSocialProfileTask', [$provider, $request->all()]);
        // checking if some data are available in the response
        // (these lines are written to make this function compatible with multiple providers)
        $tokenSecret = isset($socialUserProfile->tokenSecret) ? $socialUserProfile->tokenSecret : null;
        $expiresIn = isset($socialUserProfile->expiresIn) ? $socialUserProfile->expiresIn : null;
        $refreshToken = isset($socialUserProfile->refreshToken) ? $socialUserProfile->refreshToken : null;
        $avatar_original = isset($socialUserProfile->avatar_original) ? $socialUserProfile->avatar_original : null;

        // check if the social ID exist on any of our users, and get that user in case it was found
        $socialUser = Apiato::call('SocialAuth@FindSocialUserTask', [$provider, $socialUserProfile->id]);
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
                $provider,
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

        $user = Apiato::call('Authentication@ApiLoginThisUserObjectTask', [$user]);

        return $user;
    }

}
