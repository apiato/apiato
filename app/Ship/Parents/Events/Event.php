<?php

namespace App\Ship\Parents\Events;

use Apiato\Core\Abstracts\Events\Event as AbstractEvent;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

/**
 * Class Event
 *
 * @author  Mahmoud Zalt  <mahmoud@zalt.me>
 */
abstract class Event extends AbstractEvent
{

    use Dispatchable, InteractsWithSockets, SerializesModels;

}
