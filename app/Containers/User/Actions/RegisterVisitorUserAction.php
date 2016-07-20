<?php

namespace App\Containers\User\Actions;

use App\Containers\User\Services\CreateUserService;
use App\Containers\User\Services\FindUserService;
use App\Port\Action\Abstracts\Action;

/**
 * Class RegisterVisitorUserAction.
 *
 * @author Mahmoud Zalt <mahmoud@zalt.me>
 */
class RegisterVisitorUserAction extends Action
{

    /**
     * @var  \App\Containers\User\Actions\CreateUserService
     */
    private $createUserService;

    /**
     * @var  \App\Containers\User\Services\FindUserService
     */
    private $findUserService;

    /**
     * RegisterUserAction constructor.
     *
     * @param \App\Containers\User\Services\CreateUserService $createUserService
     * @param \App\Containers\User\Services\FindUserService   $findUserService
     */
    public function __construct(CreateUserService $createUserService, FindUserService $findUserService)
    {
        $this->createUserService = $createUserService;
        $this->findUserService = $findUserService;
    }

    /**
     * This is to be used only by a Middleware, it is a way to store records about the user
     * even before he registers. Very helpful for Mobile apps that doesn't require a user to
     * register and login before using the app.
     * Then when the user decided to register (to use some extra features) the `UpdateVisitorUserAction`
     * Action will be used to update the already created user (user will be determined by his Device ID).
     *
     * @param            $visitorId
     * @param null       $platform
     * @param null       $device
     * @param bool|false $login
     *
     * @return  mixed
     */
    public function run($visitorId, $device = null, $platform = null)
    {
        $user = $this->findUserService->byVisitorId($visitorId);

        if(!$user){
            $user = $this->createUserService->byVisitor($visitorId, $device, $platform);
        }

        return $user;
    }
}
