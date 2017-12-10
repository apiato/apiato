<?php

namespace App\Containers\User\Actions;

use Apiato\Core\Foundation\Facades\Apiato;
use App\Containers\User\Mails\UserForgotPasswordMail;
use App\Ship\Exceptions\NotFoundException;
use App\Ship\Parents\Actions\Action;
use App\Ship\Transporters\DataTransporter;
use Illuminate\Support\Facades\Mail;

/**
 * Class ForgotPasswordAction
 *
 * @author  Sebastian Weckend
 * @author  Mahmoud Zalt  <mahmoud@zalt.me>
 */
class ForgotPasswordAction extends Action
{

    /**
     * @param \App\Ship\Transporters\DataTransporter $data
     */
    public function run(DataTransporter $data): void
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
