<?php

namespace App\Containers\User\Actions;

use Apiato\Core\Foundation\Facades\Apiato;
use App\Containers\User\Mails\UserForgotPasswordMail;
use App\Ship\Exceptions\NotFoundException;
use App\Ship\Parents\Actions\Action;
use App\Ship\Parents\Requests\Request;
use Illuminate\Support\Facades\Mail;

/**
 * Class ForgotPasswordAction
 *
 * @author  Sebastian Weckend
 */
class ForgotPasswordAction extends Action
{

    /**
     * @param \App\Ship\Parents\Requests\Request $request
     */
    public function run(Request $request)
    {
        $user = Apiato::call('User@FindUserByEmailTask', [$request->email]);

        // generate token
        $token = Apiato::call('User@CreatePasswordResetTask', [$user]);

        // send email
        if (!in_array($reseturl = $request->reseturl, config('user-container.allowed-reset-password-urls'))) {
            throw new NotFoundException("The URL is incorrect ($reseturl)");
        }

        Mail::send(new UserForgotPasswordMail($user, $token, $reseturl));
    }
}
