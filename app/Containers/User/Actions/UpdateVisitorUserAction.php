<?php

namespace App\Containers\User\Actions;

use App\Containers\Authentication\Exceptions\MissingVisitorIdException;
use App\Containers\Authentication\Tasks\ApiLoginThisUserObjectTask;
use App\Containers\User\Tasks\FindUserByVisitorIdTask;
use App\Containers\User\Tasks\UpdateUserTask;
use App\Port\Action\Abstracts\Action;

/**
 * Class UpdateVisitorUserAction.
 *
 * @author Mahmoud Zalt <mahmoud@zalt.me>
 */
class UpdateVisitorUserAction extends Action
{

    /**
     * @var  \App\Containers\User\Tasks\FindUserByVisitorIdTask
     */
    private $findUserByVisitorIdTask;

    /**
     * @var  \App\Containers\User\Tasks\UpdateUserTask
     */
    private $updateUserTask;

    /**
     * @var  \App\Containers\User\Actions\ApiLoginThisUserObjectTask
     */
    private $apiLoginThisUserObjectTask;

    /**
     * UpdateVisitorUserAction constructor.
     *
     * @param \App\Containers\User\Tasks\FindUserByVisitorIdTask      $findUserByVisitorIdTask
     * @param \App\Containers\User\Tasks\UpdateUserTask               $updateUserTask
     * @param \App\Containers\User\Actions\ApiLoginThisUserObjectTask $apiLoginThisUserObjectTask
     */
    public function __construct(
        FindUserByVisitorIdTask $findUserByVisitorIdTask,
        UpdateUserTask $updateUserTask,
        ApiLoginThisUserObjectTask $apiLoginThisUserObjectTask
    ) {
        $this->findUserByVisitorIdTask = $findUserByVisitorIdTask;
        $this->updateUserTask = $updateUserTask;
        $this->apiLoginThisUserObjectTask = $apiLoginThisUserObjectTask;
    }

    /**
     * This will register an existing User Visitor. After being created by the middleware.
     * Only case the "Registration by Device ID" feature is enabled, via its middleware.
     *
     * @param      $visitorId
     * @param null $email
     * @param null $password
     * @param null $name
     *
     * @return  mixed
     */
    public function run($visitorId, $email = null, $password = null, $name = null, $gender = null, $birth = null)
    {
        if (!$visitorId) {
            throw (new MissingVisitorIdException())->debug('from (UpdateVisitorUserAction)');
        }

        $user = $this->findUserByVisitorIdTask->run($visitorId);

        if ($user) {
            // update the existing user by adding his credentials
            $user = $this->updateUserTask->run($user->id, $password, $name, $email, $gender, $birth);
            // Login the User from his object
            $user = $this->apiLoginThisUserObjectTask->run($user);
        }

        return $user;
    }
}
