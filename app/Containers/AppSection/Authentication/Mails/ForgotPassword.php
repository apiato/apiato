<?php

namespace App\Containers\AppSection\Authentication\Mails;

use App\Containers\AppSection\User\Models\User;
use App\Ship\Parents\Mails\Mail as ParentMail;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;

class ForgotPassword extends ParentMail implements ShouldQueue
{
    use Queueable;

    public function __construct(
        protected User $recipient,
        protected string $token,
        protected string $reseturl,
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
                'app_url' => config('app.url'),
            ]);
    }
}
