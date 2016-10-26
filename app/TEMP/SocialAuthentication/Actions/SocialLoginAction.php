<?php

namespace App\Containers\SocialAuthentication\Actions;

use App\Containers\Authentication\Tasks\ApiLoginThisUserObjectTask;
use App\Containers\SocialAuthentication\Tasks\CreateUserBySocialProfileTask;
use App\Containers\SocialAuthentication\Tasks\GetUserSocialProfileTask;
use App\Containers\SocialAuthentication\Tasks\UpdateUserSocialProfileTask;
use App\Containers\SocialAuthentication\Tasks\FindSocialUserTask;
use App\Containers\User\Tasks\FindUserByVisitorIdTask;
use App\Port\Action\Abstracts\Action;

/**
 * Class SocialLoginAction.
 *
 * @author Mahmoud Zalt <mahmoud@zalt.me>
 */
class SocialLoginAction extends Action
{

    /**
     * @var  \App\Containers\SocialAuthentication\Tasks\GetUserSocialProfileTask
     */
    private $getUserSocialProfileTask;

    /**
     * @var  \App\Containers\SocialAuthentication\Tasks\FindSocialUserTask
     */
    private $findSocialUserTask;

    /**
     * @var  \App\Containers\User\Tasks\CreateUserBySocialProfileTask
     */
    private $createUserBySocialProfileTask;

    /**
     * @var  \App\Containers\User\Tasks\UpdateUserSocialProfileTask
     */
    private $updateUserSocialProfileTask;

    /**
     * @var  \App\Containers\SocialAuthentication\Actions\ApiLoginThisUserObjectTask
     */
    private $apiLoginThisUserObjectTask;

    /**
     * @var  \App\Containers\User\Tasks\FindUserByVisitorIdTask
     */
    private $findUserByVisitorIdTask;

    /**
     * SocialLoginAction constructor.
     *
     * @param \App\Containers\SocialAuthentication\Tasks\GetUserSocialProfileTask      $getUserSocialProfileTask
     * @param \App\Containers\SocialAuthentication\Tasks\FindSocialUserTask                            $findSocialUserTask
     * @param \App\Containers\User\Tasks\FindUserByVisitorIdTask                       $findUserByVisitorIdTask
     * @param \App\Containers\SocialAuthentication\Tasks\createUserBySocialProfileTask $createUserBySocialProfileTask
     * @param \App\Containers\SocialAuthentication\Tasks\UpdateUserSocialProfileTask   $updateUserSocialProfileTask
     * @param \App\Containers\Authentication\Tasks\ApiLoginThisUserObjectTask          $apiLoginThisUserObjectTask
     */
    public function __construct(
        GetUserSocialProfileTask $getUserSocialProfileTask,
        FindSocialUserTask $findSocialUserTask,
        FindUserByVisitorIdTask $findUserByVisitorIdTask,
        CreateUserBySocialProfileTask $createUserBySocialProfileTask,
        UpdateUserSocialProfileTask $updateUserSocialProfileTask,
        ApiLoginThisUserObjectTask $apiLoginThisUserObjectTask
    ) {
        $this->getUserSocialProfileTask = $getUserSocialProfileTask;
        $this->findSocialUserTask = $findSocialUserTask;
        $this->findUserByVisitorIdTask = $findUserByVisitorIdTask;
        $this->createUserBySocialProfileTask = $createUserBySocialProfileTask;
        $this->updateUserSocialProfileTask = $updateUserSocialProfileTask;
        $this->apiLoginThisUserObjectTask = $apiLoginThisUserObjectTask;
    }

    /**
     * How this function works:
     *
     * -- if was visitor
     * ----- if has social profile
     * --------- [A] update his social profile info
     * ----- if has no social profile
     * --------- [B] update his visitor profile to become social profile
     * -- if was not visitor
     * ----- if has social profile
     * --------- [A] update his social profile info
     * ----- if has no social profile
     * --------- [C] create new record
     *
     * @param      $provider
     * @param null $visitorId
     *
     * @return  mixed
     */
    public function run($provider, $visitorId = null, $requestData = null)
    {
        // TODO: to be updated/replaced

        // TODO: needs refactoring so bad :D

        // fetch the user data from facebook
        $socialUserProfile = $this->getUserSocialProfileTask->run($provider);

        // checking if some data are available in the response
        // (these lines are written to make this function compatible with multiple providers)
        $tokenSecret = isset($socialUserProfile->tokenSecret) ? : null;
        $expiresIn = isset($socialUserProfile->expiresIn) ? : null;
        $refreshToken = isset($socialUserProfile->refreshToken) ? : null;
        $avatar_original = isset($socialUserProfile->avatar_original) ? : null;

        // check if the social ID exist on any of our users, and get that user in case it was found
        $socialUser = $this->findSocialUserTask->run($provider, $socialUserProfile->id);

        // check if the user was a visitor before, (to prevent duplicating existing users)
        if ($visitorId) {
            $visitorUser = $this->findUserByVisitorIdTask->run($visitorId);
        }

        if (isset($visitorUser)) {

            if ($socialUser) {
                // THIS IS: A VISITOR AND ALREADY HAVE A SOCIAL PROFILE
                // DO: UPDATE THE EXISTING USER SOCIAL PROFILE.

                // Only update tokens and updated information. Never override the user profile.
                $user = $this->updateUserSocialProfileTask->run($socialUser->id, $socialUserProfile->token,
                    $expiresIn, $refreshToken, $tokenSecret, $socialUserProfile->avatar, $avatar_original);
            } else {
                // THIS IS: A VISITOR USER THAT NEVER HAD A SOCIAL PROFILE
                // DO: CONVERT USER FROM VISITOR (EMPTY PROFILE) TO SOCIAL PROFILE (BY FILLING ALL HIS PROFILE)

                // NOTE: if the user was visitor, and used FB to register, then used Twitter to login, I will not fill all his profile from Twitter,
                // I will only update his tokens information and the provider (keeping his previously collected info from FB).
                $user = $this->updateUserSocialProfileTask->run($visitorUser->id, $socialUserProfile->token,
                    $expiresIn, $refreshToken, $tokenSecret, $socialUserProfile->avatar, $avatar_original, $provider,
                    $socialUserProfile->id, $socialUserProfile->nickname, $socialUserProfile->name,
                    $socialUserProfile->email);
            }

        } else {

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
        }

        $user = $this->apiLoginThisUserObjectTask->run($user);

        return $user;
    }

}
