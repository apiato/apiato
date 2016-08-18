<?php

namespace App\Containers\Authentication\Tasks;

use App\Containers\Authentication\Adapters\JwtAuthAdapter;
use App\Containers\Authentication\Exceptions\AuthenticationFailedException;
use App\Port\Task\Abstracts\Task;
use Exception;

/**
 * Class ApiLoginThisUserObjectTask.
 *
 * @author Mahmoud Zalt <mahmoud@zalt.me>
 */
class ApiLoginThisUserObjectTask extends Task
{

    /**
     * @var \App\Containers\Authentication\Adapters\JwtAuthAdapter
     */
    private $jwtAuthAdapter;

    /**
     * ApiLoginThisUserObjectTask constructor.
     *
     * @param \App\Containers\Authentication\Adapters\JwtAuthAdapter $jwtAuthAdapter
     */
    public function __construct(JwtAuthAdapter $jwtAuthAdapter)
    {
        $this->jwtAuthAdapter = $jwtAuthAdapter;
    }

    /**
     * login user from it's object. (no username and password needed)
     * useful for logging in new created users (during registration).
     *
     * @param $user
     *
     * @return mixed
     */
    public function run($user)
    {
        try {
            $token = $this->jwtAuthAdapter->fromUser($user);
        } catch (Exception $e) {
            throw (new AuthenticationFailedException())->debug($e);
        }

        // manually authenticate the user
        $this->jwtAuthAdapter->authenticateViaToken($token);

        // inject the token on the model
        $user = $user->injectToken($token);

        return $user;
    }

}
