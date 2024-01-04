<?php

namespace App\Containers\AppSection\SocialAuth\Actions;

use Apiato\Core\Abstracts\Actions\Action;
use App\Containers\AppSection\SocialAuth\Tasks\ApiLoginFromUserTask;
use App\Containers\AppSection\SocialAuth\Tasks\CreateUserBySocialProfileTask;
use App\Containers\AppSection\SocialAuth\Tasks\FindSocialUserTask;
use App\Containers\AppSection\SocialAuth\Tasks\FindUserSocialProfileTask;
use App\Containers\AppSection\SocialAuth\Tasks\UpdateUserSocialProfileTask;
use App\Containers\AppSection\SocialAuth\UI\API\Requests\ApiAuthenticateRequest;

final class SocialLoginAction extends Action
{
    /**
     * ----- if has social profile
     * --------- [A] update his social profile info
     * ----- if has no social profile
     * --------- [C] create new record.
     */
    public function run(ApiAuthenticateRequest $request): array
    {
        $provider = $request->provider;
        $providerInstance = app(GetSocialAuthProviderInstanceSubAction::class)->run($request);

        // fetch the user data from the supported platforms
        $userSocialProfile = app(FindUserSocialProfileTask::class)->run($providerInstance);

        // checking if some data are available in the response
        // (these lines are written to make this function compatible with multiple providers)
        $tokenSecret = $userSocialProfile->tokenSecret ?? null;
        $expiresIn = $userSocialProfile->expiresIn ?? null;
        $refreshToken = $userSocialProfile->refreshToken ?? null;
        $avatar_original = $userSocialProfile->avatar_original ?? null;

        // check if the social ID exist on any of our users, and get that user in case it was found
        $socialUser = app(FindSocialUserTask::class)->run($provider, $userSocialProfile->id);

        if ($socialUser) {
            // THIS IS: A USER AND ALREADY HAVE A SOCIAL PROFILE
            // DO: UPDATE THE EXISTING USER SOCIAL PROFILE.

            // Only update tokens and updated information. Never override the user profile.
            $user = app(UpdateUserSocialProfileTask::class)->run(
                $socialUser->id,
                $userSocialProfile->token,
                $expiresIn,
                $refreshToken,
                $tokenSecret,
                $userSocialProfile->avatar,
                $avatar_original,
            );
        } else {
            // THIS IS: A NEW USER
            // DO: CREATE NEW USER FROM THE SOCIAL PROFILE INFORMATION.
            $user = app(CreateUserBySocialProfileTask::class)->run(
                $provider,
                $userSocialProfile->token,
                $userSocialProfile->id,
                $userSocialProfile->nickname,
                $userSocialProfile->name,
                $userSocialProfile->email,
                $userSocialProfile->avatar,
                $tokenSecret,
                $expiresIn,
                $refreshToken,
                $avatar_original,
            );
        }

        // Authenticate the user from its object
        $personalAccessTokenResult = app(ApiLoginFromUserTask::class)->run($user);

        return [
            'user' => $user,
            'token' => $personalAccessTokenResult,
        ];
    }
}
