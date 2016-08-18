<?php

namespace App\Containers\Authentication\Tasks;

use App\Containers\Authentication\Adapters\JwtAuthAdapter;
use App\Containers\Authentication\Exceptions\MissingTokenException;
use App\Port\Task\Abstracts\Task;

/**
 * Class ApiLogoutTask.
 *
 * @author Mahmoud Zalt <mahmoud@zalt.me>
 */
class ApiLogoutTask extends Task
{

    /**
     * @var \App\Containers\Authentication\Adapters\JwtAuthAdapter
     */
    private $jwtAuthAdapter;

    /**
     * ApiLogoutTask constructor.
     *
     * @param \App\Containers\Authentication\Adapters\JwtAuthAdapter $jwtAuthAdapter
     */
    public function __construct(JwtAuthAdapter $jwtAuthAdapter)
    {
        $this->jwtAuthAdapter = $jwtAuthAdapter;
    }

    /**
     * @param $authorizationHeader
     *
     * @throws \App\Containers\Authentication\Tasks\MissingTokenException
     *
     * @return bool
     */
    public function run($authorizationHeader)
    {
        // remove the `Bearer` string from the header and keep only the token
        $token = str_replace('Bearer', '', $authorizationHeader);

        $ok = $this->jwtAuthAdapter->invalidate($token);

        if (!$ok) {
            throw new MissingTokenException();
        }

        return true;
    }

}
