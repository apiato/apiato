<?php

namespace App\Containers\User\Actions;

use App\Containers\ApiAuthentication\Exceptions\MissingVisitorIdException;
use App\Containers\ApiAuthentication\Services\ApiAuthenticationService;
use App\Containers\User\Services\CreateUserService;
use App\Containers\User\Services\FindUserService;
use App\Containers\User\Services\UpdateUserService;
use App\Port\Action\Abstracts\Action;

/**
 * Class UpdateVisitorUserAction.
 *
 * @author Mahmoud Zalt <mahmoud@zalt.me>
 */
class UpdateVisitorUserAction extends Action
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
        if (!$visitorId) {
            throw (new MissingVisitorIdException())->debug('from (UpdateVisitorUserAction)');
        }

        $user = $this->findUserService->byVisitorId($visitorId);

        if ($user) {
            // update the existing user by adding his credentials
            $user = $this->updateUserService->run($user->id, $password, $name, $email);
            // Login the User from his object
            $user = $this->apiAuthenticationService->loginFromObject($user);
        } else {
            // create the user now, in case that user have registered from the first screen
            $user = $this->createUserService->byCredentials($email, $password, $name, true);
        }

        return $user;
    }
}
