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
     * @return  \Tymon\JWTAuth\JWTAuth
     */
    public function parseToken()
    {
        return $this->jwtAuth->parseToken();
    }

    /**
     * @param $user
     *
     * @return mixed
     */
    public function fromUser($user, array $customClaims = [])
    {
        return $this->jwtAuth->fromUser($user, $customClaims);
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
     * @return  \Tymon\JWTAuth\Payload
     */
    public function getPayload()
    {
        return $this->jwtAuth->getPayload();
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
    public function authenticateViaToken($token = null)
    {
        return $this->jwtAuth->authenticate($token);
    }

    /**
     * @param $customClaims
     *
     * @return  mixed
     */
    public function makeTokenWithCustomClaims($customClaims)
    {
        $payload = \Tymon\JWTAuth\Facades\JWTFactory::make($customClaims);

        return $this->jwtAuth->encode($payload)->get();
    }

}
