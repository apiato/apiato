<?php

namespace App\Containers\Authentication\Adapters;
use Tymon\JWTAuth\Facades\JWTFactory;
use Tymon\JWTAuth\JWTAuth;

/**
 * Class JWTAuthTask.
 *
 * @author Mahmoud Zalt <mahmoud@zalt.me>
 */
class JwtAuthAdapter
{

    /**
     * @var  \Tymon\JWTAuth\JWTAuth
     */
    private $jwtAuth;

    /**
     * JwtAuthAdapter constructor.
     *
     * @param \Tymon\JWTAuth\JWTAuth $jwtAuth
     */
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
     * @param bool $token
     *
     * @return  \Tymon\JWTAuth\Payload
     */
    public function getPayload($token = false)
    {
        return $this->jwtAuth->getPayload($token);
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
        $payload = JWTFactory::make($customClaims);

        return $this->jwtAuth->encode($payload)->get();
    }

}
