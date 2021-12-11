<?php

namespace App\Containers\AppSection\Authentication\Mails;

use App\Ship\Parents\Mails\Mail;
use App\Ship\Parents\Models\UserModel;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;

class ForgotPassword extends Mail implements ShouldQueue
{
    use Queueable;

    public function __construct(
        protected UserModel $recipient,
        protected string $token,
        protected string $reseturl
    ) {
    }

    public function build(): static
    {
        return $this->view('appSection@authentication::forgot-password')
            ->to($this->recipient->email, $this->recipient->name)
            ->with([
                'token' => $this->token,
                'reseturl' => $this->reseturl,
                'email' => $this->recipient->email,
            ]);
    }
}
