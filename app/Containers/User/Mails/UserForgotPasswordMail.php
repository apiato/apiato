<?php

namespace App\Containers\User\Mails;

use App\Containers\User\Models\User;
use App\Ship\Parents\Mails\Mail;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;

/**
 * Class UserForgotPasswordMail
 */
class UserForgotPasswordMail extends Mail implements ShouldQueue
{
    use Queueable;

    protected $recipient;
    protected $token;
    protected $reseturl;

    /**
     * UserForgotPasswordMail constructor.
     *
     * @param User $recipient
     * @param $token
     * @param $reseturl
     */
    public function __construct(User $recipient, $token, $reseturl)
    {
        $this->recipient = $recipient;
        $this->token = $token;
        $this->reseturl = $reseturl;
    }

    public function build()
    {
        return $this->view('user::user-forgotPassword')
            ->to($this->recipient->email, $this->recipient->name)
            ->with([
                'token' => $this->token,
                'reseturl' => $this->reseturl,
                'email' => $this->recipient->email,
            ]);
    }
}