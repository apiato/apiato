<?php

namespace App\Containers\WebAuthentication\Services;

use App\Containers\WebAuthentication\Exceptions\AuthenticationFailedException;
use Illuminate\Auth\AuthManager as Auth;
/**
 * Class WebAuthenticationService.
 *
 * @author Mahmoud Zalt <mahmoud@zalt.me>
 */
class WebAuthenticationService
{

    /**
     * @var  \Illuminate\Auth\AuthManager
     */
    private $auth;

    /**
     * WebAuthenticationService constructor.
     *
     * @param \Illuminate\Auth\AuthManager $auth
     */
    public function __construct(Auth $auth)
    {
        $this->auth = $auth;
    }

    /**
     * @param $email
     * @param $password
     *
     * @return mixed
     */
    public function login($email, $password)
    {
        $correct = $this->auth->attempt(['email' => $email, 'password' => $password]);

        if(!$correct){
            throw new AuthenticationFailedException();
        }

        return $this->auth->user();
    }


}
