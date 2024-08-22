<?php

namespace App\Containers\AppSection\User\Notifications;

use App\Ship\Parents\Models\UserModel;
use App\Ship\Parents\Notifications\Notification as ParentNotification;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

final class PasswordUpdatedNotification extends ParentNotification implements ShouldQueue
{
    use Queueable;

    public function via($notifiable): array
    {
        return ['mail'];
    }

    public function toMail(UserModel $notifiable): MailMessage
    {
        return (new MailMessage())
            ->subject('Account Change Notice')
            ->line('We wanted to let you know that some information was changed for your account:')
            ->line('Your password has been change.')
            ->line('If you recently made account changes, please disregard this message. However, if you did NOT make any changes to your account, we recommend you change your password and make appropriate corrections as soon as possible to ensure account security.');
    }
}
