<?php

namespace Apiato\Core\Abstracts\Notifications;

use Illuminate\Notifications\Notification as LaravelNotification;
use Illuminate\Support\Facades\Config;

/**
 * Class Notification
 *
 * @author  Mahmoud Zalt  <mahmoud@zalt.me>
 */
class Notification extends LaravelNotification
{

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return Config::get('notification.channels');
    }

}
