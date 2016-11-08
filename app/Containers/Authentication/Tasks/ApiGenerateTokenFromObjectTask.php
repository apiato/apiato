<?php

namespace App\Containers\Authentication\Tasks;

use App\Containers\Authentication\Adapters\JwtAuthAdapter;
use App\Containers\Authentication\Exceptions\AuthenticationFailedException;
use App\Port\Task\Abstracts\Task;
use Exception;

/**
 * Class ApiGenerateTokenFromObjectTask.
 *
 * @author Mahmoud Zalt <mahmoud@zalt.me>
 */
class ApiGenerateTokenFromObjectTask extends Task
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
     * @param $user
     *
     * @return  mixed
     */
    public function run($user)
    {
        try {
            $token = $this->jwtAuthAdapter->fromUser($user);
        } catch (Exception $e) {
            throw (new AuthenticationFailedException())->debug($e);
        }

        return $token;
    }

}
