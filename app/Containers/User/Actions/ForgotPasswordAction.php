<?php

namespace App\Containers\User\Actions;

use App\Containers\User\Mails\UserForgotPasswordMail;
use App\Ship\Parents\Actions\Action;
use Apiato\Core\Foundation\Facades\Apiato;
use App\Ship\Parents\Requests\Request;
use Illuminate\Support\Facades\Mail;

class ForgotPasswordAction extends Action
{
    public function run(Request $request)
    {
        $user = Apiato::call('User@FindUserByEmailTask', [$request->email]);
        //generate token
        $token = Apiato::call('User@CreatePasswordResetTask', [$user]);

        //send email
        if (in_array($reseturl = $request->reseturl, config('user-container.allowed-reset-password-urls'))) Mail::send(new UserForgotPasswordMail($user, $token, $reseturl));

    }
}
