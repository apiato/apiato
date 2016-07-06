<?php

namespace App\Portainers\ApiAuthentication\Portals;

use Exception;
use Illuminate\Auth\AuthManager as LaravelAuthManager;
use App\Portainers\ApiAuthentication\Adapters\JwtAuthAdapter;
use App\Portainers\ApiAuthentication\Exceptions\AuthenticationFailedException;
use App\Portainers\ApiAuthentication\Exceptions\MissingTokenException;

/**
 * Class ApiAuthenticationService.
 *
 * @author Mahmoud Zalt <mahmoud@zalt.me>
 */
class ApiAuthenticationService
{

    /**
     * @var \App\Portainers\ApiAuthentication\Adapters\JwtAuthAdapter
     */
    private $jwtAuthAdapter;

    /**
     * @var \Illuminate\Auth\AuthManager
     */
    private $authManager;

    /**
     * ApiAuthenticationService constructor.
     *
     * @param \App\Portainers\ApiAuthentication\Adapters\JwtAuthAdapter $jwtAuthAdapter
     * @param \Illuminate\Auth\AuthManager                          $authManager
     */
    public function __construct(JwtAuthAdapter $jwtAuthAdapter, LaravelAuthManager $authManager)
    {
        $this->jwtAuthAdapter = $jwtAuthAdapter;
        $this->authManager = $authManager;
    }

    /**
     * @param $email
     * @param $password
     *
     * @return mixed
     */
    public function login($email, $password)
    {
        try {
            $token = $this->jwtAuthAdapter->attempt([
                'email'    => $email,
                'password' => $password,
            ]);

            if (!$token) {
                throw new AuthenticationFailedException();
            }
        } catch (Exception $e) {
            // something went wrong whilst attempting to encode the token
            throw (new AuthenticationFailedException())->debug($e);
        }

        return $token;
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

        // inject the token on the model
        $user = $user->injectToken($token);

        return $user;
    }

    /**
     * get the user object of the current authenticated user
     * inject the token on it if a token is provided.
     *
     * @param null $token
     *
     * @return mixed
     */
    public function getAuthenticatedUser($token = null)
    {
        if (!$user = $this->authManager->user()) {
            throw new AuthenticationFailedException('User is not logged in.');
        }

        return $token ? $user->injectToken($token) : $user;
    }

    /**
     * @param $authorizationHeader
     *
     * @throws \App\Portainers\ApiAuthentication\Portals\MissingTokenException
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
