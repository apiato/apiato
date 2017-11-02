<?php

namespace App\Containers\User\Actions;

use App\Containers\User\Events\UserRegisteredEvent;
use App\Containers\User\Mails\UserRegisteredMail;
use App\Containers\User\Notifications\UserRegisteredNotification;
use App\Ship\Parents\Actions\Action;
use App\Ship\Parents\Requests\Request;
use Illuminate\Contracts\Bus\Dispatcher;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Notification;
use Apiato\Core\Foundation\Facades\Apiato;

/**
 * Class RegisterUserAction.
 *
 * @author Mahmoud Zalt <mahmoud@zalt.me>
 */
class RegisterUserAction extends Action
{

    /**
     * @param \App\Ship\Parents\Requests\Request $request
     *
     * @return  mixed
     */
    public function run(Request $request)
    {
        // create user record in the database and return it.
        $user = Apiato::call('User@CreateUserByCredentialsTask', [
            $isClient = true,
            $request->email,
            $request->password,
            $request->name,
            $request->gender,
            $request->birth
        ]);

        Mail::send(new UserRegisteredMail($user));

        Notification::send($user, new UserRegisteredNotification($user));

        App::make(Dispatcher::class)->dispatch(New UserRegisteredEvent($user));

        return $user;
    }
}
