<?php

namespace App\Containers\User\Notifications;

use App\Containers\User\Models\User;
use App\Ship\Parents\Notifications\Notification;
use Illuminate\Bus\Queueable;

class UserRegisteredNotification extends Notification
{

    use Queueable;

    /**
     * @var  \App\Containers\User\Models\User
     */
    protected $user;

    /**
     * UserRegisteredNotification constructor.
     *
     * @param \App\Containers\User\Models\User $user
     */
    public function __construct(User $user)
    {
        $this->user = $user;
    }

    /**
     * @param  mixed $notifiable
     *
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            // ... do you own customization
        ];
    }

}
