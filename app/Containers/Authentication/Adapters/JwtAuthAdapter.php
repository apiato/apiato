<?php

namespace App\Containers\Authentication\Adapters;

use Tymon\JWTAuth\JWTAuth;

/**
 * Class JWTAuthTask.
 *
 * @author Mahmoud Zalt <mahmoud@zalt.me>
 */
class JwtAuthAdapter
{

    /**
     * @var \JWTAuth
     */
    private $jwtAuth;

    public function __construct(JWTAuth $jwtAuth)
    {
        $this->jwtAuth = $jwtAuth;
    }

    /**
     * @param $credentials
     *
     * @return mixed
     */
    public function attempt($credentials)
    {
        return $this->jwtAuth->attempt($credentials);
    }

    /**
     * @param $token
     *
     * @return mixed
     */
    public function toUser($token)
    {
        return $this->jwtAuth->toUser($token);
    }

    /**
     * @param $user
     *
     * @return mixed
     */
    public function fromUser($user)
    {
        return $this->jwtAuth->fromUser($user);
    }

    /**
     * @param bool|false $token
     *
     * @return mixed
     */
    public function invalidate($token)
    {
        return $this->jwtAuth->invalidate($token);
    }

    /**
     * @return mixed
     */
    public function getToken()
    {
        return $this->jwtAuth->getToken();
    }

    /**
     * @param $token
     *
     * @return mixed
     */
    public function setToken($token)
    {
        return $this->jwtAuth->setToken($token);
    }

    /**
     * @param $token
     *
     * @return  mixed
     */
    public function authenticateViaToken($token)
    {
        return $this->jwtAuth->authenticate($token);
    }
}
