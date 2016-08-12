<?php

namespace App\Containers\WebAuthentication\Actions;

use App\Containers\WebAuthentication\Exceptions\AuthenticationFailedException;
use App\Containers\WebAuthentication\Services\WebAuthenticationService;
use App\Port\Action\Abstracts\Action;

/**
 * Class AdminLoginAction.
 *
 * @author Mahmoud Zalt <mahmoud@zalt.me>
 */
class AdminLoginAction extends Action
{

    /**
     * @var  \App\Containers\WebAuthentication\Services\WebAuthenticationService
     */
    private $authenticationService;

    /**
     * LoginAction constructor.
     *
     * @param \App\Containers\WebAuthentication\Services\WebAuthenticationService $authenticationService
     */
    public function __construct(WebAuthenticationService $authenticationService)
    {
        $this->authenticationService = $authenticationService;
    }

    /**
     * @param $email
     * @param $password
     * @param $remember
     *
     * @return  array|mixed
     */
    public function run($email, $password, $remember)
    {
        try {
            $user = $this->authenticationService->login($email, $password, $remember);
        } catch (AuthenticationFailedException $e) {
            return ['message' => 'Authentication Failed.'];
        }

        // check if is Admin
        $isAdmin = $user->hasRole('admin');

        if (!$isAdmin) {
            return ['message' => 'User is not Admin.'];
        }

        return $user;
    }
}
