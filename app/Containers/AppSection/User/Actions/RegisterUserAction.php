<?php

namespace App\Containers\AppSection\User\Actions;

use App\Containers\AppSection\User\Events\UserRegisteredEvent;
use App\Containers\AppSection\User\Mails\UserRegisteredMail;
use App\Containers\AppSection\User\Models\User;
use App\Containers\AppSection\User\Notifications\UserRegisteredNotification;
use App\Containers\AppSection\User\Tasks\CreateUserByCredentialsTask;
use App\Containers\AppSection\User\UI\API\Requests\RegisterUserRequest;
use App\Ship\Parents\Actions\Action;
use Illuminate\Contracts\Bus\Dispatcher;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Notification;

class RegisterUserAction extends Action
{
    public function run(RegisterUserRequest $request): User
    {
        $user = app(CreateUserByCredentialsTask::class)->run(
            false,
            $request->email,
            $request->password,
            $request->name,
            $request->gender,
            $request->birth
        );

        Mail::send(new UserRegisteredMail($user));
        Notification::send($user, new UserRegisteredNotification($user));
        app(Dispatcher::class)->dispatch(new UserRegisteredEvent($user));

        return $user;
    }
}
