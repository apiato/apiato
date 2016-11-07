<?php

namespace App\Containers\Authentication\Tasks;

use App\Containers\Authentication\Adapters\JwtAuthAdapter;
use App\Containers\Authentication\Exceptions\AuthenticationFailedException;
use App\Port\Task\Abstracts\Task;
use Exception;

/**
 * Class ApiLoginWithCredentialsTask.
 *
 * @author Mahmoud Zalt <mahmoud@zalt.me>
 */
class ApiLoginWithCredentialsTask extends Task
{

    /**
     * @var \App\Containers\Authentication\Adapters\JwtAuthAdapter
     */
    private $jwtAuthAdapter;

    /**
     * ApiLoginWithCredentialsTask constructor.
     *
     * @param \App\Containers\Authentication\Adapters\JwtAuthAdapter $jwtAuthAdapter
     */
    public function __construct(JwtAuthAdapter $jwtAuthAdapter)
    {
        $this->jwtAuthAdapter = $jwtAuthAdapter;
    }

    /**
     * @param $email
     * @param $password
     *
     * @return mixed
     */
    public function run($email, $password)
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

}
