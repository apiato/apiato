<?php

namespace App\Containers\User\Actions;

use App\Ship\Exceptions\InternalErrorException;
use App\Ship\Parents\Actions\Action;
use App\Ship\Parents\Exceptions\Exception;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Str;

/**
 * Class ResetPasswordAction
 *
 * * @author  Sebastian Weckend
 */
class ResetPasswordAction extends Action
{

    /**
     * @param string $email
     * @param string $password
     * @param string $token
     */
    public function run(
        string $email,
        string $password,
        string $token
    ): void {

        $data = [
            'email'                 => $email,
            'token'                 => $token,
            'password'              => $password,
            'password_confirmation' => $password,
        ];

        try {
            Password::broker()->reset(
                $data,
                function ($user, $password) {
                    $user->forceFill([
                        'password'       => Hash::make($password),
                        'remember_token' => Str::random(60),
                    ])->save();
                }
            );
        } catch (Exception $e) {
            throw new InternalErrorException();
        }
    }
}
