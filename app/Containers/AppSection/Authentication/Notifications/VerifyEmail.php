<?php

namespace App\Containers\AppSection\Authentication\Notifications;

use App\Ship\Parents\Models\UserModel;
use App\Ship\Parents\Notifications\Notification;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class VerifyEmail extends Notification implements ShouldQueue
{
    use Queueable;

    public function via($notifiable): array
    {
        return ['mail'];
    }

    public function toMail(UserModel $notifiable): MailMessage
    {
        return (new MailMessage())
            ->subject('Verify Email Address')
            ->line('Please click the button below to verify your email address.')
            ->action('Verify Email Address', $this->createUrl($notifiable))
            ->line('If you did not create an account, no further action is required.');
    }

    private function createUrl(UserModel $notifiable): string
    {
        $id = config('apiato.hash-id') ? $notifiable->getHashedKey() : $notifiable->getKey();
        $hash = sha1($notifiable->getEmailForVerification());

        return request('verification_url') . "/$id/$hash";
    }
}
