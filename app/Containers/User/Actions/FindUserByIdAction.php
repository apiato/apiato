<?php

namespace App\Containers\User\Actions;

use App\Containers\User\Exceptions\UserNotFoundException;
use App\Containers\User\Services\FindUserService;
use App\Port\Action\Abstracts\Action;

/**
 * Class FindUserByIdAction.
 *
 * @author Mahmoud Zalt <mahmoud@zalt.me>
 */
class FindUserByIdAction extends Action
{

    /**
     * @var  \App\Containers\User\Services\FindUserService
     */
    private $findUserService;

    /**
     * FindUserByIdAction constructor.
     *
     * @param \App\Containers\User\Services\FindUserService $findUserService
     */
    public function __construct(
        FindUserService $findUserService
    ) {
        $this->findUserService = $findUserService;
    }


    /**
     * @param $id
     *
     * @return  mixed
     */
    public function run($id)
    {
        try {
            $user = $this->findUserService->byId($id);
        } catch (Exception $e) {
            throw new UserNotFoundException;
        }

        return $user;
    }
}
