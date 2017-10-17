<?php

namespace App\Containers\SocialAuth\Tasks;

use App\Containers\Socialauth\Exceptions\AccountFailedException;
use App\Containers\User\Data\Repositories\UserRepository;
use App\Ship\Parents\Tasks\Task;
use Exception;

/**
 * Class CreateUserBySocialProfileTask.
 *
 * @author Mahmoud Zalt <mahmoud@zalt.me>
 */
class CreateUserBySocialProfileTask extends Task
{

    /**
     * @var  \App\Containers\User\Data\Repositories\UserRepository
     */
    private $userRepository;

    /**
     * CreateUserBySocialProfileTask constructor.
     *
     * @param \App\Containers\User\Data\Repositories\UserRepository $userRepository
     */
    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }


    /**
     * @param      $provider
     * @param null $token
     * @param null $socialId
     * @param null $nickname
     * @param null $name
     * @param null $email
     * @param null $avatar
     * @param null $tokenSecret
     * @param null $expiresIn
     * @param null $refreshToken
     * @param null $avatar_original
     *
     * @return mixed
     * @throws AccountFailedException
     */
    public function run(
        $provider,
        $token = null,
        $socialId = null,
        $nickname = null,
        $name = null,
        $email = null,
        $avatar = null,
        $tokenSecret = null,
        $expiresIn = null,
        $refreshToken = null,
        $avatar_original = null
    ) {

        $data = [
            'social_provider'        => $provider,
            'social_token'           => $token,
            'social_refresh_token'   => $refreshToken,
            'social_token_secret'    => $tokenSecret,
            'social_expires_in'      => $expiresIn,
            'social_id'              => $socialId,
            'social_nickname'        => $nickname,
            'social_avatar'          => $avatar,
            'social_avatar_original' => $avatar_original,
            'email'                  => $email,
            'name'                   => $name,
        ];

        try {
            // create new user
            $user = $this->userRepository->create($data);
        } catch (Exception $e) {
            throw (new AccountFailedException())->debug($e);
        }

        return $user;
    }


}
