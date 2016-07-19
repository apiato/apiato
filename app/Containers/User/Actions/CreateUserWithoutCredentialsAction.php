<?php

namespace App\Containers\User\Actions;

use App\Containers\User\Services\CreateUserService;
use App\Port\Action\Abstracts\Action;

/**
 * Class CreateUserWithoutCredentialsAction.
 *
 * @author Mahmoud Zalt <mahmoud@zalt.me>
 */
class CreateUserWithoutCredentialsAction extends Action
{

    /**
     * @var  \App\Containers\User\Actions\CreateUserService
     */
    private $createUserService;

    /**
     * CreateUserWithCredentialsAction constructor.
     *
     * @param \App\Containers\User\Services\CreateUserService $createUserService
     */
    public function __construct(CreateUserService $createUserService)
    {
        $this->createUserService = $createUserService;
    }

    /**
     * @param            $agentId
     * @param null       $platform
     * @param null       $device
     * @param bool|false $login
     *
     * @return  mixed
     */
    public function run($agentId, $device = null, $platform = null)
    {
        $user = $this->createUserService->byAgent($agentId, $device, $platform);

        return $user;
    }
}
