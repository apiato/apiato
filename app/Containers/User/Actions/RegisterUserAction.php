<?php

namespace App\Containers\User\Actions;

use App\Port\Action\Abstracts\Action;

/**
 * Class RegisterUserAction.
 *
 * @author Mahmoud Zalt <mahmoud@zalt.me>
 */
class RegisterUserAction extends Action
{

    /**
     * @var  \App\Containers\User\Actions\UpdateVisitorUserAction
     */
    private $updateVisitorUserAction;

    /**
     * @var  \App\Containers\User\Actions\CreateUserAction
     */
    private $createUserAction;

    /**
     * RegisterUserAction constructor.
     *
     * @param \App\Containers\User\Actions\UpdateVisitorUserAction $updateVisitorUserAction
     * @param \App\Containers\User\Actions\CreateUserAction        $createUserAction
     */
    public function __construct(UpdateVisitorUserAction $updateVisitorUserAction, CreateUserAction $createUserAction)
    {
        $this->updateVisitorUserAction = $updateVisitorUserAction;
        $this->createUserAction = $createUserAction;
    }

    /**
     * @param      $email
     * @param      $password
     * @param      $name
     * @param null $gender
     * @param null $birth
     * @param bool $login
     * @param null $visitorId
     *
     * @return  mixed
     */
    public function run($email, $password, $name, $gender = null, $birth = null, $login = false, $visitorId = null)
    {

        // if visitor ID is given then try to find that user and update it's record
        if ($visitorId) {
            $user = $this->updateVisitorUserAction->run(
                $visitorId,
                $email,
                $password,
                $name,
                $gender,
                $birth
            );
        }

        // if visitor ID is not provided OR if the above code didn't find the user by his visitor ID then create new record
        if (!$visitorId || $user == null) {
            $user = $this->createUserAction->run(
                $email,
                $password,
                $name,
                $gender,
                $birth,
                $login
            );
        }

        return $user;
    }
}
