<?php

namespace App\Containers\User\Actions;

use Apiato\Core\Foundation\Facades\Apiato;
use App\Containers\User\Mails\UserForgotPasswordMail;
use App\Containers\User\UI\API\Requests\ForgotPasswordRequest;
use App\Ship\Exceptions\NotFoundException;
use App\Ship\Parents\Actions\Action;
use Illuminate\Support\Facades\Mail;

class ForgotPasswordAction extends Action
{
    public function run(ForgotPasswordRequest $data): void
    {
        $user = Apiato::call('User@FindUserByEmailTask', [$data->email]);

        // generate token
        $token = Apiato::call('User@CreatePasswordResetTask', [$user]);

        // get last segment of the URL
        $resetUrl = $data->reseturl;
        $url = explode('/', $resetUrl);
        $lastSegment = $url[count($url) - 1];

        // validate the allowed endpoint is being used
        if (!in_array($lastSegment, config('user-container.allowed-reset-password-urls'))) {
            throw new NotFoundException("The URL is not allowed ($resetUrl)");
        }

        // send email
        Mail::send(new UserForgotPasswordMail($user, $token, $resetUrl));
    }
}
