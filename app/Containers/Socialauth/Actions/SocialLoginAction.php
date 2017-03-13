<?php

namespace App\Containers\SocialAuth\Actions;

use App\Containers\Authentication\Tasks\ApiLoginThisUserObjectTask;
use App\Containers\SocialAuth\Tasks\CreateUserBySocialProfileTask;
use App\Containers\SocialAuth\Tasks\FindSocialUserTask;
use App\Containers\SocialAuth\Tasks\GetUserSocialProfileTask;
use App\Containers\SocialAuth\Tasks\UpdateUserSocialProfileTask;
use App\Port\Action\Abstracts\Action;

/**
 * Class SocialLoginAction.
 *
 * @author Mahmoud Zalt <mahmoud@zalt.me>
 */
class SocialLoginAction extends Action
{

    /**
     * @var \App\Containers\SocialAuth\Tasks\GetUserSocialProfileTask
     */
    private $getUserSocialProfileTask;

    /**
     * @var \App\Containers\SocialAuth\Tasks\FindSocialUserTask
     */
    private $findSocialUserTask;

    /**
     * @var \App\Containers\SocialAuth\Tasks\CreateUserBySocialProfileTask
     */
    private $createUserBySocialProfileTask;

    /**
     * @var \App\Containers\SocialAuth\Tasks\UpdateUserSocialProfileTask
     */
    private $updateUserSocialProfileTask;

    /**
     * @var \App\Containers\Authentication\Tasks\ApiLoginThisUserObjectTask
     */
    private $apiLoginThisUserObjectTask;

    /**
     * SocialLoginAction constructor.
     *
     * @param \App\Containers\SocialAuth\Tasks\GetUserSocialProfileTask       $getUserSocialProfileTask
     * @param \App\Containers\SocialAuth\Tasks\FindSocialUserTask             $findSocialUserTask
     * @param \App\Containers\SocialAuth\Tasks\CreateUserBySocialProfileTask  $createUserBySocialProfileTask
     * @param \App\Containers\SocialAuth\Tasks\UpdateUserSocialProfileTask    $updateUserSocialProfileTask
     * @param \App\Containers\Authentication\Tasks\ApiLoginThisUserObjectTask $apiLoginThisUserObjectTask
     */
    public function __construct(
        GetUserSocialProfileTask $getUserSocialProfileTask,
        FindSocialUserTask $findSocialUserTask,
        CreateUserBySocialProfileTask $createUserBySocialProfileTask,
        UpdateUserSocialProfileTask $updateUserSocialProfileTask,
        ApiLoginThisUserObjectTask $apiLoginThisUserObjectTask
    ) {
        $this->getUserSocialProfileTask = $getUserSocialProfileTask;
        $this->findSocialUserTask = $findSocialUserTask;
        $this->createUserBySocialProfileTask = $createUserBySocialProfileTask;
        $this->updateUserSocialProfileTask = $updateUserSocialProfileTask;
        $this->apiLoginThisUserObjectTask = $apiLoginThisUserObjectTask;
    }

    /**
     * ----- if has social profile
     * --------- [A] update his social profile info
     * ----- if has no social profile
     * --------- [C] create new record
     *
     * @param            $provider
     * @param array|null $requestData
     *
     * @return  mixed
     */
    public function run($provider, array $requestData = null)
    {
        // TODO: needs refactoring so bad :D

        // fetch the user data from facebook
        $socialUserProfile = $this->getUserSocialProfileTask->run($provider, $requestData);

        // checking if some data are available in the response
        // (these lines are written to make this function compatible with multiple providers)
        $tokenSecret = isset($socialUserProfile->tokenSecret) ? $socialUserProfile->tokenSecret : null;
        $expiresIn = isset($socialUserProfile->expiresIn) ? $socialUserProfile->expiresIn : null;
        $refreshToken = isset($socialUserProfile->refreshToken) ? $socialUserProfile->refreshToken : null;
        $avatar_original = isset($socialUserProfile->avatar_original) ? $socialUserProfile->avatar_original : null;

        // check if the social ID exist on any of our users, and get that user in case it was found
        $socialUser = $this->findSocialUserTask->run($provider, $socialUserProfile->id);

        if ($socialUser) {
            // THIS IS: A USER AND ALREADY HAVE A SOCIAL PROFILE
            // DO: UPDATE THE EXISTING USER SOCIAL PROFILE.

            // Only update tokens and updated information. Never override the user profile.
            $user = $this->updateUserSocialProfileTask->run($socialUser->id, $socialUserProfile->token,
                $expiresIn, $refreshToken, $tokenSecret, $socialUserProfile->avatar, $avatar_original);

        } else {
            // THIS IS: A NEW USER
            // DO: CREATE NEW USER FROM THE SOCIAL PROFILE INFORMATION.

            $user = $this->createUserBySocialProfileTask->run($provider, $socialUserProfile->token,
                $socialUserProfile->id,
                $socialUserProfile->nickname, $socialUserProfile->name, $socialUserProfile->email,
                $socialUserProfile->avatar, $tokenSecret, $expiresIn, $refreshToken, $avatar_original);
        }

        $user = $this->apiLoginThisUserObjectTask->run($user);

        return $user;
    }

}
