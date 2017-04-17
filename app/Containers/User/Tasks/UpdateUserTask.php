<?php

namespace App\Containers\User\Tasks;

use App\Containers\User\Data\Repositories\UserRepository;
use App\Containers\User\Exceptions\UpdateResourceFailedException;
use App\Ship\Parents\Tasks\Task;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Hash;

/**
 * Class UpdateUserTask.
 *
 * @author Mahmoud Zalt <mahmoud@zalt.me>
 */
class UpdateUserTask extends Task
{

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
     * @throws \App\Containers\User\Exceptions\UpdateResourceFailedException
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
        // set all data in the array, then remove all null values and their keys
        $attributes = array_filter([
            'password'             => $password ? Hash::make($password) : null,
            'name'                 => $name,
            'email'                => $email,
            'gender'               => $gender,
            'birth'                => $birth,
            'social_token'         => $token,
            'social_expires_in'    => $expiresIn,
            'social_refresh_token' => $refreshToken,
            'social_token_secret'  => $tokenSecret,
        ]);

        // optionally, check if data is empty and return error
        if (!$attributes) {
            throw new UpdateResourceFailedException('Inputs are empty.');
        }

        // updating the attributes
        $user = App::make(UserRepository::class)->update($attributes, $userId);

        return $user;
    }

}
