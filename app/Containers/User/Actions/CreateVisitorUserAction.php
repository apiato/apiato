<?php

namespace App\Containers\User\Actions;

use App\Containers\User\Tasks\CreateUserByVisitorIdTask;
use App\Containers\User\Tasks\FindUserByVisitorIdTask;
use App\Port\Action\Abstracts\Action;

/**
 * Class CreateVisitorUserAction.
 *
 * @author Mahmoud Zalt <mahmoud@zalt.me>
 */
class CreateVisitorUserAction extends Action
{

    /**
     * @var  \App\Containers\User\Actions\CreateUserByVisitorIdTask
     */
    private $createUserByVisitorIdTask;

    /**
     * @var  \App\Containers\User\Tasks\FindUserByVisitorIdTask
     */
    private $findUserByVisitorIdTask;

    /**
     * CreateUserAction constructor.
     *
     * @param \App\Containers\User\Tasks\CreateUserByVisitorIdTask $createUserByVisitorIdTask
     * @param \App\Containers\User\Tasks\FindUserByVisitorIdTask   $findUserByVisitorIdTask
     */
    public function __construct(
        CreateUserByVisitorIdTask $createUserByVisitorIdTask,
        FindUserByVisitorIdTask $findUserByVisitorIdTask
    ) {
        $this->createUserByVisitorIdTask = $createUserByVisitorIdTask;
        $this->findUserByVisitorIdTask = $findUserByVisitorIdTask;
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
        $user = $this->findUserByVisitorIdTask->run($visitorId);

        if (!$user) {
            $user = $this->createUserByVisitorIdTask->run($visitorId, $device, $platform);
        }

        return $user;
    }
}
