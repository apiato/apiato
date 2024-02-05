<?php

namespace App\Containers\AppSection\Authentication\Notifications;

use App\Containers\AppSection\User\Models\User;
use App\Ship\Parents\Notifications\Notification as ParentNotification;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

final class Welcome extends ParentNotification implements ShouldQueue
{
    use Queueable;

    public function via($notifiable): array
    {
        return ['mail'];
    }

    public function toMail(User $notifiable): MailMessage
    {
        return (new MailMessage())
            ->subject('Welcome to ' . config('app.name'))
            ->line('Thank you for registering ' . $notifiable->name);
    }
}
