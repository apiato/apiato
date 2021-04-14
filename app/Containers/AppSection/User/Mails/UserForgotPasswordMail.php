<?php

namespace App\Containers\AppSection\User\Mails;

use App\Containers\AppSection\User\Models\User;
use App\Ship\Parents\Mails\Mail;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;

class UserForgotPasswordMail extends Mail implements ShouldQueue
{
    use Queueable;

    protected User $recipient;

    protected string $token;

    protected string $reseturl;

    public function __construct(User $recipient, $token, $reseturl)
    {
        $this->recipient = $recipient;
        $this->token = $token;
        $this->reseturl = $reseturl;
    }

    public function build(): self
    {
        return $this->view('appSection@user::user-forgotPassword')
            ->to($this->recipient->email, $this->recipient->name)
            ->with([
                'token' => $this->token,
                'reseturl' => $this->reseturl,
                'email' => $this->recipient->email,
            ]);
    }
}
