<?php

namespace App\Containers\SocialAuthentication\Actions;

use App\Containers\ApiAuthentication\Services\ApiAuthenticationService;
use App\Containers\SocialAuthentication\Services\GetUserSocialProfileService;
use App\Containers\User\Services\CreateUserService;
use App\Containers\User\Services\FindUserService;
use App\Containers\User\Services\UpdateUserService;
use App\Port\Action\Abstracts\Action;

/**
 * Class SocialLoginAction.
 *
 * @author Mahmoud Zalt <mahmoud@zalt.me>
 */
class SocialLoginAction extends Action
{

    /**
     * @var  \App\Containers\SocialAuthentication\Services\GetUserSocialProfileService
     */
    private $getUserSocialProfileService;

    /**
     * @var  \App\Containers\User\Services\FindUserService
     */
    private $findUserService;

    /**
     * @var  \App\Containers\User\Services\CreateUserService
     */
    private $createUserService;

    /**
     * @var  \App\Containers\User\Services\UpdateUserService
     */
    private $updateUserService;

    /**
     * @var  \App\Containers\SocialAuthentication\Actions\ApiAuthenticationService
     */
    private $apiAuthenticationService;

    /**
     * SocialLoginAction constructor.
     *
     * @param \App\Containers\SocialAuthentication\Services\GetUserSocialProfileService $getUserSocialProfileService
     * @param \App\Containers\User\Services\FindUserService                             $findUserService
     * @param \App\Containers\User\Services\CreateUserService                           $createUserService
     * @param \App\Containers\User\Services\UpdateUserService                           $updateUserService
     * @param \App\Containers\ApiAuthentication\Services\ApiAuthenticationService       $apiAuthenticationService
     */
    public function __construct(
        GetUserSocialProfileService $getUserSocialProfileService,
        FindUserService $findUserService,
        CreateUserService $createUserService,
        UpdateUserService $updateUserService,
        ApiAuthenticationService $apiAuthenticationService
    ) {
        $this->getUserSocialProfileService = $getUserSocialProfileService;
        $this->findUserService = $findUserService;
        $this->createUserService = $createUserService;
        $this->updateUserService = $updateUserService;
        $this->apiAuthenticationService = $apiAuthenticationService;
    }

    /**
     * @param $provider
     *
     * @return  mixed
     */
    public function run($provider)
    {
        // fetch the user data from facebook
        $socialUserProfile = $this->getUserSocialProfileService->run($provider);

        // find if that user exist in our database
        $user = $this->findUserService->bySocialId($provider, $socialUserProfile->id);

        // if user not found then create new one
        if (!$user) {
            // create new user form the facebook user object and log him in
            $user = $this->createUserService->bySocial(
                $provider,
                $socialUserProfile->token,
                $socialUserProfile->id,
                $socialUserProfile->nickname,
                $socialUserProfile->name,
                $socialUserProfile->email,
                $socialUserProfile->avatar,
                isset($socialUserProfile->tokenSecret) ? : null,
                isset($socialUserProfile->expiresIn) ? : null,
                isset($socialUserProfile->refreshToken) ? : null,
                isset($socialUserProfile->avatar_original) ? : null
            );
        } else {
            // if the user exist then update the Tokens
            $user = $this->updateUserService->run($user->id, null, null, null, null, null, $socialUserProfile->token,
                $socialUserProfile->expiresIn, $socialUserProfile->refreshToken, $socialUserProfile->tokenSecret);
        }

        $user = $this->apiAuthenticationService->loginFromObject($user);

        return $user;
    }
}
