<?php

namespace App\Ship\Parents\Notifications;

use Illuminate\Bus\Queueable;
use Apiato\Core\Abstracts\Notifications\Notification as ApiatoNotification;


class Notification extends ApiatoNotification
{

    use Queueable;

}
