<?php

namespace App\Containers\User\Tasks;

use App\Containers\User\Events\Events\UserCreatedEvent;
use App\Ship\Parents\Actions\Action;
use Illuminate\Events\Dispatcher as EventsDispatcher;
use Illuminate\Support\Facades\App;

/**
 * Class FireUserCreatedEventTask.
 *
 * @author Mahmoud Zalt <mahmoud@zalt.me>
 */
class FireUserCreatedEventTask extends Action
{
    /**
     * @param $user
     *
     * @return  mixed
     */
    public function run($user)
    {
        return App::make(EventsDispatcher::class)->dispatch(New UserCreatedEvent($user));
    }
}
