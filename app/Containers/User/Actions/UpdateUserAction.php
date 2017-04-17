<?php

namespace App\Containers\User\Actions;

use App\Containers\Authentication\Tasks\GetAuthenticatedUserTask;
use App\Containers\User\Tasks\UpdateUserTask;
use App\Ship\Parents\Actions\Action;
use App\Ship\Parents\Requests\Request;
use Illuminate\Support\Facades\Hash;

/**
 * Class UpdateUserAction.
 *
 * @author Mahmoud Zalt <mahmoud@zalt.me>
 */
class UpdateUserAction extends Action
{

    /**
     * @param \App\Ship\Parents\Requests\Request $request
     *
     * @return  mixed
     */
    public function run(Request $request)
    {
        // user can only update himself
        $userId = $this->call(GetAuthenticatedUserTask::class)->id;

        $userData = [
            'password'             => $request->password ? Hash::make($request->password) : null,
            'name'                 => $request->name,
            'email'                => $request->email,
            'gender'               => $request->gender,
            'birth'                => $request->birth,
            'social_token'         => $request->token,
            'social_expires_in'    => $request->expiresIn,
            'social_refresh_token' => $request->refreshToken,
            'social_token_secret'  => $request->tokenSecret,
        ];

        return $this->call(UpdateUserTask::class, [$userData, $userId]);
    }
}
