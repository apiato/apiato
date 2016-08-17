<?php

namespace App\Containers\User\Actions;

use App\Containers\ApiAuthentication\Tasks\ApiAuthenticationTask;
use App\Containers\User\Tasks\CreateUserByCredentialsTask;
use App\Containers\User\Tasks\FindUserByVisitorIdTask;
use App\Containers\User\Tasks\UpdateUserTask;
use App\Port\Action\Abstracts\Action;

/**
 * Class SwitchVisitorToUserAction.
 *
 * @author Mahmoud Zalt <mahmoud@zalt.me>
 */
class SwitchVisitorToUserAction extends Action
{

    /**
     * @var  \App\Containers\User\Tasks\UpdateUserTask
     */
    private $updateUserTask;

    /**
     * @var  \App\Containers\User\Tasks\FindUserByVisitorIdTask
     */
    private $findUserByVisitorIdTask;

    /**
     * @var  \App\Containers\User\Tasks\CreateUserByCredentialsTask
     */
    private $createUserByCredentialsTask;

    /**
     * @var  \App\Containers\ApiAuthentication\Tasks\ApiAuthenticationTask
     */
    private $apiAuthenticationTask;

    /**
     * UpdateUserAction constructor.
     *
     * @param \App\Containers\User\Tasks\UpdateUserTask                     $updateUserTask
     * @param \App\Containers\User\Tasks\FindUserByVisitorIdTask            $findUserByVisitorIdTask
     * @param \App\Containers\User\Tasks\CreateUserByCredentialsTask        $createUserByCredentialsTask
     * @param \App\Containers\ApiAuthentication\Tasks\ApiAuthenticationTask $apiAuthenticationTask
     */
    public function __construct(
        UpdateUserTask $updateUserTask,
        FindUserByVisitorIdTask $findUserByVisitorIdTask,
        CreateUserByCredentialsTask $createUserByCredentialsTask,
        ApiAuthenticationTask $apiAuthenticationTask
    ) {
        $this->updateUserTask = $updateUserTask;
        $this->findUserByVisitorIdTask = $findUserByVisitorIdTask;
        $this->createUserByCredentialsTask = $createUserByCredentialsTask;
        $this->apiAuthenticationTask = $apiAuthenticationTask;
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
    public function run($visitorId, $email = null, $password = null, $name = null)
    {

        $user = $this->findUserByVisitorIdTask->run($visitorId);

        if ($user) {
            // update the existing user by adding his credentials
            $user = $this->updateUserTask->run($user->id, $password, $name, $email);
            // Login the User from his object
            $user = $this->apiAuthenticationTask->loginFromObject($user);
        } else {
            // create the user now, in case that user have registered from the first screen
            $user = $this->createUserByCredentialsTask->run($email, $password, $name, true);
        }

        return $user;
    }
}
