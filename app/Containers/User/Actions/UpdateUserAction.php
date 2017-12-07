<?php

namespace App\Containers\User\Actions;

use Apiato\Core\Foundation\Facades\Apiato;
use App\Containers\User\Models\User;
use App\Ship\Parents\Actions\Action;
use Illuminate\Support\Facades\Hash;

/**
 * Class UpdateUserAction.
 *
 * @author Mahmoud Zalt <mahmoud@zalt.me>
 */
class UpdateUserAction extends Action
{

    /**
     * @param string $id
     * @param string $email
     * @param string $password
     * @param string $name
     * @param string $gender
     * @param string $birth
     * @param string $token
     * @param string $expiresIn
     * @param string $refreshToken
     * @param string $tokenSecret
     *
     * @return  mixed
     */
    public function run(
        string $id,
        string $email = null,
        string $password = null,
        string $name = null,
        string $gender = null,
        string $birth = null,
        string $token = null,
        string $expiresIn = null,
        string $refreshToken = null,
        string $tokenSecret = null
    ): User {

        $userData = [
            'email'                => $email,
            'password'             => $password ? Hash::make($password) : null,
            'name'                 => $name,
            'gender'               => $gender,
            'birth'                => $birth,
            'social_token'         => $token,
            'social_expires_in'    => $expiresIn,
            'social_refresh_token' => $refreshToken,
            'social_token_secret'  => $tokenSecret,
        ];

        // remove null values and their keys
        $userData = array_filter($userData);

        $user = Apiato::call('User@UpdateUserTask', [$userData, $id]);

        return $user;
    }
}
