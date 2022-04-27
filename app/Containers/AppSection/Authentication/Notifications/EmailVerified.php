<?php

namespace App\Containers\AppSection\Authentication\Notifications;

use App\Ship\Parents\Models\UserModel;
use App\Ship\Parents\Notifications\Notification as ParentNotification;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class EmailVerified extends ParentNotification implements ShouldQueue
{
    use Queueable;

    public function via($notifiable): array
    {
        return ['mail'];
    }

    public function toMail(UserModel $notifiable): MailMessage
    {
        return (new MailMessage())
            ->subject('Email Verified')
            ->line('Your email has been verified.');
    }
}
