<?php

namespace App\Containers\User\Actions;

use App\Containers\User\Services\UpdateUserService;
use App\Port\Action\Abstracts\Action;

/**
 * Class UpdateUserAction.
 *
 * @author Mahmoud Zalt <mahmoud@zalt.me>
 */
class UpdateUserAction extends Action
{

    /**
     * @var  \App\Containers\User\Services\UpdateUserService
     */
    private $updateUserService;

    /**
     * UpdateUserAction constructor.
     *
     * @param \App\Containers\User\Services\UpdateUserService $updateUserService
     */
    public function __construct(UpdateUserService $updateUserService)
    {
        $this->updateUserService = $updateUserService;
    }

    /**
     * @param      $userId
     * @param null $password
     * @param null $name
     * @param null $email
     *
     * @return  mixed
     */
    public function run($userId, $password = null, $name = null, $email = null)
    {
        $user = $this->updateUserService->run($userId, $password, $name, $email);

        return $user;
    }
}
