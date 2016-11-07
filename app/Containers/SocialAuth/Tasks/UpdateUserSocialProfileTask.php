<?php

namespace App\Containers\SocialAuth\Tasks;

use App\Containers\ApiAuthentication\Exceptions\UpdateResourceFailedException;
use App\Containers\User\Contracts\UserRepositoryInterface;
use App\Port\Task\Abstracts\Task;

/**
 * Class UpdateUserSocialProfileTask.
 *
 * @author Mahmoud Zalt <mahmoud@zalt.me>
 */
class UpdateUserSocialProfileTask extends Task
{

    /**
     * @var \App\Containers\User\Contracts\UserRepositoryInterface
     */
    private $userRepository;

    /**
     * UpdateUserAction constructor.
     *
     * @param \App\Containers\User\Contracts\UserRepositoryInterface $userRepository
     */
    public function __construct(UserRepositoryInterface $userRepository)
    {
        $this->userRepository = $userRepository;
    }


    /**
     * @param      $userId
     * @param null $token
     * @param null $expiresIn
     * @param null $refreshToken
     * @param null $tokenSecret
     * @param null $provider
     * @param null $avatar
     * @param null $avatar_original
     * @param null $socialId
     * @param null $nickname
     * @param null $name
     * @param null $email
     *
     * @return  mixed
     */
    public function run(
        $userId,
        $token = null,
        $expiresIn = null,
        $refreshToken = null,
        $tokenSecret = null,
        $avatar = null,
        $avatar_original = null,
        $provider = null,
        $socialId = null,
        $nickname = null,
        $name = null,
        $email = null
    ) {
        $attributes = [];

        if ($token) {
            $attributes['social_token'] = $token;
        }

        if ($expiresIn) {
            $attributes['social_expires_in'] = $expiresIn;
        }

        if ($refreshToken) {
            $attributes['social_refresh_token'] = $refreshToken;
        }

        if ($tokenSecret) {
            $attributes['social_token_secret'] = $tokenSecret;
        }

        if ($provider) {
            $attributes['social_provider'] = $provider;
        }

        if ($avatar) {
            $attributes['social_avatar'] = $avatar;
        }

        if ($avatar_original) {
            $attributes['social_avatar_original'] = $avatar_original;
        }

        if ($socialId) {
            $attributes['social_id'] = $socialId;
        }

        if ($nickname) {
            $attributes['social_nickname'] = $nickname;
        }

        if ($name) {
            $attributes['name'] = $name;
        }

        if ($email) {
            $attributes['email'] = $email;
        }

        // check if data is empty
        if (!$attributes) {
            throw new UpdateResourceFailedException('Inputs are empty.');
        }

        // updating the attributes
        $user = $this->userRepository->update($attributes, $userId);

        return $user;
    }


}
