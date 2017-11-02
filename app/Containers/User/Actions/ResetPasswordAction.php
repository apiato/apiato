<?php

namespace App\Containers\User\Actions;

use App\Ship\Exceptions\InternalErrorException;
use App\Ship\Parents\Actions\Action;
use App\Ship\Parents\Exceptions\Exception;
use App\Ship\Parents\Requests\Request;
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
     * @param \App\Ship\Parents\Requests\Request $request
     *
     * @throws InternalErrorException
     */
    public function run(Request $request)
    {
        $data = [
            'email'                 => $request->email,
            'token'                 => $request->token,
            'password'              => $request->password,
            'password_confirmation' => $request->password,
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
