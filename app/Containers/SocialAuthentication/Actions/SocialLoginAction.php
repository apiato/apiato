<?php

namespace App\Containers\SocialAuthentication\Actions;

use App\Containers\Authentication\Tasks\ApiLoginThisUserObjectTask;
use App\Containers\SocialAuthentication\Tasks\GetUserSocialProfileTask;
use App\Containers\User\Tasks\CreateUserBySocialProfileTask;
use App\Containers\User\Tasks\FindSocialUserTask;
use App\Containers\User\Tasks\UpdateUserTask;
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
     * @var  \App\Containers\User\Tasks\FindSocialUserTask
     */
    private $findSocialUserTask;

    /**
     * @var  \App\Containers\User\Tasks\CreateUserBySocialProfileTask
     */
    private $createUserBySocialProfileTask;

    /**
     * @var  \App\Containers\User\Tasks\UpdateUserTask
     */
    private $updateUserTask;

    /**
     * @var  \App\Containers\SocialAuthentication\Actions\ApiLoginThisUserObjectTask
     */
    private $apiLoginThisUserObjectTask;

    /**
     * SocialLoginAction constructor.
     *
     * @param \App\Containers\SocialAuthentication\Tasks\GetUserSocialProfileTask $getUserSocialProfileTask
     * @param \App\Containers\User\Tasks\FindSocialUserTask                       $findSocialUserTask
     * @param \App\Containers\User\Tasks\CreateUserBySocialProfileTask            $createUserBySocialProfileTask
     * @param \App\Containers\User\Tasks\UpdateUserTask                           $updateUserTask
     * @param \App\Containers\Authentication\Tasks\ApiLoginThisUserObjectTask     $apiLoginThisUserObjectTask
     */
    public function __construct(
        GetUserSocialProfileTask $getUserSocialProfileTask,
        FindSocialUserTask $findSocialUserTask,
        CreateUserBySocialProfileTask $createUserBySocialProfileTask,
        UpdateUserTask $updateUserTask,
        ApiLoginThisUserObjectTask $apiLoginThisUserObjectTask
    ) {
        $this->getUserSocialProfileTask = $getUserSocialProfileTask;
        $this->findSocialUserTask = $findSocialUserTask;
        $this->createUserBySocialProfileTask = $createUserBySocialProfileTask;
        $this->updateUserTask = $updateUserTask;
        $this->apiLoginThisUserObjectTask = $apiLoginThisUserObjectTask;
    }

    /**
     * @param $provider
     *
     * @return  mixed
     */
    public function run($provider)
    {
        // fetch the user data from facebook
        $socialUserProfile = $this->getUserSocialProfileTask->run($provider);

        // find if that user exist in our database
        $user = $this->findSocialUserTask->run($provider, $socialUserProfile->id);

        $tokenSecret = isset($socialUserProfile->tokenSecret) ? : null;
        $expiresIn = isset($socialUserProfile->expiresIn) ? : null;
        $refreshToken = isset($socialUserProfile->refreshToken) ? : null;
        $avatar_original = isset($socialUserProfile->avatar_original) ? : null;

        // if user not found then create new one
        if (!$user) {
            // create new user form the facebook user object and log him in
            $user = $this->createUserBySocialProfileTask->run(
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
            );
        } else {
            // if the user exist then update the Tokens
            $user = $this->updateUserTask->run($user->id, null, null, null, null, null,
                $tokenSecret, $expiresIn, $refreshToken, $avatar_original);
        }

        $user = $this->apiLoginThisUserObjectTask->run($user);

        return $user;
    }
}
