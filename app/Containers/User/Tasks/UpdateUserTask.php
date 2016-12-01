<?php

namespace App\Containers\User\Tasks;

use App\Containers\Authentication\Exceptions\UpdateResourceFailedException;
use App\Containers\User\Contracts\UserRepositoryInterface;
use App\Port\Task\Abstracts\Task;
use Illuminate\Support\Facades\Hash;

/**
 * Class UpdateUserTask.
 *
 * @author Mahmoud Zalt <mahmoud@zalt.me>
 */
class UpdateUserTask extends Task
{

    /**
     * @var  \App\Containers\User\Contracts\UserRepositoryInterface
     */
    private $userRepository;

    /**
     * UpdateUserTask constructor.
     *
     * @param \App\Containers\User\Contracts\UserRepositoryInterface $userRepository
     */
    public function __construct(UserRepositoryInterface $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    /**
     * @param      $userId
     * @param null $password
     * @param null $name
     * @param null $email
     * @param null $gender
     * @param null $birth
     * @param null $token
     * @param null $expiresIn
     * @param null $refreshToken
     * @param null $tokenSecret
     *
     * @return  mixed
     */
    public function run(
        $userId,
        $password = null,
        $name = null,
        $email = null,
        $gender = null,
        $birth = null,
        $token = null,
        $expiresIn = null,
        $refreshToken = null,
        $tokenSecret = null
    ) {
        $attributes = [];

        if ($password) {
            $attributes['password'] = Hash::make($password);
        }

        if ($name) {
            $attributes['name'] = $name;
        }

        if ($email) {
            $attributes['email'] = $email;
        }

        if ($gender) {
            $attributes['gender'] = $gender;
        }

        if ($birth) {
            $attributes['birth'] = $birth;
        }
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

        // check if data is empty
        if (!$attributes) {
            throw new UpdateResourceFailedException('Inputs are empty.');
        }

        // updating the attributes
        $user = $this->userRepository->update($attributes, $userId);

        return $user;
    }

}
