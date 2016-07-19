<?php

namespace App\Containers\User\Actions;

use App\Containers\ApiAuthentication\Exceptions\MissingAgentIdException;
use App\Containers\ApiAuthentication\Services\ApiAuthenticationService;
use App\Containers\User\Services\CreateUserService;
use App\Containers\User\Services\FindUserService;
use App\Containers\User\Services\UpdateUserService;
use App\Port\Action\Abstracts\Action;
use App\Port\Exception\Exceptions\InternalErrorException;

/**
 * Class UpdateAgentUserAction.
 *
 * @author Mahmoud Zalt <mahmoud@zalt.me>
 */
class UpdateAgentUserAction extends Action
{

    /**
     * @var  \App\Containers\User\Services\UpdateUserService
     */
    private $updateUserService;

    /**
     * @var  \App\Containers\User\Services\FindUserService
     */
    private $findUserService;

    /**
     * @var  \App\Containers\User\Services\CreateUserService
     */
    private $createUserService;

    /**
     * @var  \App\Containers\ApiAuthentication\Services\ApiAuthenticationService
     */
    private $apiAuthenticationService;

    /**
     * UpdateUserAction constructor.
     *
     * @param \App\Containers\User\Services\UpdateUserService                     $updateUserService
     * @param \App\Containers\User\Services\FindUserService                       $findUserService
     * @param \App\Containers\User\Services\CreateUserService                     $createUserService
     * @param \App\Containers\ApiAuthentication\Services\ApiAuthenticationService $apiAuthenticationService
     */
    public function __construct(
        UpdateUserService $updateUserService,
        FindUserService $findUserService,
        CreateUserService $createUserService,
        ApiAuthenticationService $apiAuthenticationService
    ) {
        $this->updateUserService = $updateUserService;
        $this->findUserService = $findUserService;
        $this->createUserService = $createUserService;
        $this->apiAuthenticationService = $apiAuthenticationService;
    }

    /**
     * @param      $agentId
     * @param null $email
     * @param null $password
     * @param null $name
     *
     * @return  mixed
     */
    public function run($agentId, $email = null, $password = null, $name = null)
    {
        if (!$agentId) {
            throw (new MissingAgentIdException())->debug('from (UpdateAgentUserAction)');
        }

        $user = $this->findUserService->byAgentId($agentId);

        // There should be no way a user is not created, since before hitting this action's endpoint
        // a middleware already checking if the user exist by his Agent-Id header, and if not found
        // he automatically creates it.
        if (!$user) {
            throw new InternalErrorException('Something went wrong while registering a user!');
        }

        $user = $this->updateUserService->run($user->id, $password, $name, $email);

        // Login the User from its object
        $user = $this->apiAuthenticationService->loginFromObject($user);

        return $user;
    }
}
