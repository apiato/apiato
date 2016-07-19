<?php

namespace App\Containers\User\Actions;

use App\Containers\User\Events\Events\UserCreatedEvent;
use App\Containers\User\Services\CreateUserService;
use App\Port\Action\Abstracts\Action;
use App\Port\Event\Dispatcher\EventsDispatcher;

/**
 * Class RegisterUserAction.
 *
 * @author Mahmoud Zalt <mahmoud@zalt.me>
 */
class RegisterUserAction extends Action
{

    /**
     * @var  \App\Containers\User\Actions\CreateUserService
     */
    private $createUserService;

    /**
     * @var  \App\Port\Event\Dispatcher\EventsDispatcher
     */
    private $eventsDispatcher;

    /**
     * RegisterUserAction constructor.
     *
     * @param \App\Containers\User\Services\CreateUserService $createUserService
     * @param \App\Port\Event\Dispatcher\EventsDispatcher     $eventsDispatcher
     */
    public function __construct(CreateUserService $createUserService, EventsDispatcher $eventsDispatcher)
    {
        $this->createUserService = $createUserService;
        $this->eventsDispatcher = $eventsDispatcher;
    }

    /**
     * create a new user object.
     * optionally can login the created user and return it with its token.
     *
     * @param      $email
     * @param      $password
     * @param      $name
     * @param bool $login determine weather to login or not after creating
     *
     * @return mixed
     */
    public function run($email, $password, $name, $login = false)
    {
        $user = $this->createUserService->byCredentials($email, $password, $name, $login);

        // Fire a User Created Event
        $this->eventsDispatcher->fire(New UserCreatedEvent($user));

        return $user;
    }
}
