<?php

namespace App\Containers\User\Actions;

use App\Containers\User\Tasks\CreateUserTask;
use App\Containers\User\Tasks\FindUserTask;
use App\Port\Action\Abstracts\Action;

/**
 * Class CreateVisitorUserAction.
 *
 * @author Mahmoud Zalt <mahmoud@zalt.me>
 */
class CreateVisitorUserAction extends Action
{

    /**
     * @var  \App\Containers\User\Actions\CreateUserTask
     */
    private $createUserTask;

    /**
     * @var  \App\Containers\User\Tasks\FindUserTask
     */
    private $findUserTask;

    /**
     * CreateUserAction constructor.
     *
     * @param \App\Containers\User\Tasks\CreateUserTask $createUserTask
     * @param \App\Containers\User\Tasks\FindUserTask   $findUserTask
     */
    public function __construct(CreateUserTask $createUserTask, FindUserTask $findUserTask)
    {
        $this->createUserTask = $createUserTask;
        $this->findUserTask = $findUserTask;
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
        $user = $this->findUserTask->byVisitorId($visitorId);

        if(!$user){
            $user = $this->createUserTask->byVisitor($visitorId, $device, $platform);
        }

        return $user;
    }
}
