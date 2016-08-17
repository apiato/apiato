<?php

namespace App\Containers\Authentication\Tasks;

use App\Containers\Authentication\Adapters\JwtAuthAdapter;
use App\Containers\Authentication\Exceptions\AuthenticationFailedException;
use App\Containers\Authentication\Exceptions\MissingTokenException;
use Exception;
use Illuminate\Auth\AuthManager as LaravelAuthManager;

/**
 * Class ApiAuthenticationTask.
 *
 * @author Mahmoud Zalt <mahmoud@zalt.me>
 */
class ApiAuthenticationTask
{

    /**
     * @var \App\Containers\Authentication\Adapters\JwtAuthAdapter
     */
    private $jwtAuthAdapter;

    /**
     * @var \Illuminate\Auth\AuthManager
     */
    private $authManager;

    /**
     * AuthenticationTask constructor.
     *
     * @param \App\Containers\Authentication\Adapters\JwtAuthAdapter $jwtAuthAdapter
     * @param \Illuminate\Auth\AuthManager                              $authManager
     */
    public function __construct(JwtAuthAdapter $jwtAuthAdapter, LaravelAuthManager $authManager)
    {
        $this->jwtAuthAdapter = $jwtAuthAdapter;
        $this->authManager = $authManager;
    }

    /**
     * login user from it's object. (no username and password needed)
     * useful for logging in new created users (during registration).
     *
     * @param $user
     *
     * @return mixed
     */
    public function loginFromObject($user)
    {
        $token = $this->generateTokenFromObject($user);

        // manually authenticate the user
        $this->jwtAuthAdapter->authenticateViaToken($token);

        // inject the token on the model
        $user = $user->injectToken($token);

        return $user;
    }

    /**
     * @param $authorizationHeader
     *
     * @throws \App\Containers\Authentication\Tasks\MissingTokenException
     *
     * @return bool
     */
    public function logout($authorizationHeader)
    {
        // remove the `Bearer` string from the header and keep only the token
        $token = str_replace('Bearer', '', $authorizationHeader);

        $ok = $this->jwtAuthAdapter->invalidate($token);

        if (!$ok) {
            throw new MissingTokenException();
        }

        return true;
    }

    /**
     * login/authenticate user and return its token.
     *
     * @param $user
     *
     * @return mixed
     */
    public function generateTokenFromObject($user)
    {
        try {
            $token = $this->jwtAuthAdapter->fromUser($user);
        } catch (Exception $e) {
            throw (new AuthenticationFailedException())->debug($e);
        }

        return $token;
    }

}
