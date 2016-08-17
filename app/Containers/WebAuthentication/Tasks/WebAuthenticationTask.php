<?php

namespace App\Containers\WebAuthentication\Tasks;

use App\Containers\WebAuthentication\Exceptions\AuthenticationFailedException;
use Illuminate\Auth\AuthManager as Auth;
/**
 * Class WebAuthenticationTask.
 *
 * @author Mahmoud Zalt <mahmoud@zalt.me>
 */
class WebAuthenticationTask
{

    /**
     * @var  \Illuminate\Auth\AuthManager
     */
    private $auth;

    /**
     * WebAuthenticationTask constructor.
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
    public function login($email, $password, $remember = false)
    {
        if($remember){
            $remember = true;
        }

        $correct = $this->auth->attempt(['email' => $email, 'password' => $password], $remember);

        if(!$correct){
            // TODO: this has to be Web Exception
            throw new AuthenticationFailedException();
        }

        return $this->auth->user();
    }

    /**
     * @return  bool
     */
    public function logout()
    {
        $this->auth->logout();

        return true;
    }


}
