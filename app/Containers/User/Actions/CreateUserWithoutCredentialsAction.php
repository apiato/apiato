<?php

namespace App\Containers\User\Actions;

use App\Containers\User\Services\CreateUserService;
use App\Containers\User\Services\FindUserService;
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
     * @var  \App\Containers\User\Services\FindUserService
     */
    private $findUserService;

    /**
     * CreateUserWithCredentialsAction constructor.
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
     * @param            $agentId
     * @param null       $platform
     * @param null       $device
     * @param bool|false $login
     *
     * @return  mixed
     */
    public function run($agentId, $device = null, $platform = null)
    {
        $user = $this->findUserService->byAgentId($agentId);

        if(!$user){
            $user = $this->createUserService->byAgent($agentId, $device, $platform);
        }

        return $user;
    }
}
