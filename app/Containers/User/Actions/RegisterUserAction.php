<?php

namespace App\Containers\User\Actions;

use Apiato\Core\Foundation\Facades\Apiato;
use App\Containers\User\Events\UserRegisteredEvent;
use App\Containers\User\Mails\UserRegisteredMail;
use App\Containers\User\Models\User;
use App\Containers\User\Notifications\UserRegisteredNotification;
use App\Ship\Parents\Actions\Action;
use Illuminate\Contracts\Bus\Dispatcher;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Notification;

/**
 * Class RegisterUserAction.
 *
 * @author Mahmoud Zalt <mahmoud@zalt.me>
 */
class RegisterUserAction extends Action
{

    /**
     * @param string      $email
     * @param string      $password
     * @param string|null $name
     * @param string|null $gender
     * @param string|null $birth
     * @param bool        $isClient
     *
     * @return  \App\Containers\User\Models\User
     */
    public function run(
        string $email,
        string $password,
        string $name = null,
        string $gender = null,
        string $birth = null,
        bool $isClient = true
    ): User {

        // create user record in the database and return it.
        $user = Apiato::call('User@CreateUserByCredentialsTask', [
            $isClient,
            $email,
            $password,
            $name,
            $gender,
            $birth
        ]);

        Mail::send(new UserRegisteredMail($user));

        Notification::send($user, new UserRegisteredNotification($user));

        App::make(Dispatcher::class)->dispatch(New UserRegisteredEvent($user));

        return $user;
    }
}
