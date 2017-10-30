<?php

namespace App\Containers\User\Mails;

use App\Containers\User\Models\User;
use App\Ship\Parents\Mails\Mail;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;

/**
 * Class UserForgotPasswordMail
 *
 * @author  Sebastian Weckend
 */
class UserForgotPasswordMail extends Mail implements ShouldQueue
{

    use Queueable;

    /**
     * @var  \App\Containers\User\Models\User
     */
    protected $recipient;

    /**
     * @var string
     */
    protected $token;

    /**
     * @var string
     */
    protected $reseturl;

    /**
     * UserForgotPasswordMail constructor.
     *
     * @param \App\Containers\User\Models\User $recipient
     * @param                                  $token
     * @param                                  $reseturl
     */
    public function __construct(User $recipient, $token, $reseturl)
    {
        $this->recipient = $recipient;
        $this->token = $token;
        $this->reseturl = $reseturl;
    }

    /**
     * @return  $this
     */
    public function build()
    {
        return $this->view('user::user-forgotPassword')
            ->to($this->recipient->email, $this->recipient->name)
            ->with([
                'token'    => $this->token,
                'reseturl' => $this->reseturl,
                'email'    => $this->recipient->email,
            ]);
    }
}
