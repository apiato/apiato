<?php

namespace App\Containers\User\Events\Events;

use App\Port\Event\Abstracts\Event;
use Illuminate\Queue\SerializesModels;

/**
 * Class UserCreatedEvent
 *
 * @author  Mahmoud Zalt  <mahmoud@zalt.me>
 */
class UserCreatedEvent extends Event
{

    use SerializesModels;

    /**
     * @var
     */
    public $user;

    /**
     * UserCreatedEvent constructor.
     *
     * @param $user
     */
    public function __construct($user)
    {
        $this->user = $user;
    }

    /**
     * Get the channels the event should be broadcast on.
     *
     * @return array
     */
    public function broadcastOn()
    {
        return [];
    }
}
