<?php

namespace App\Containers\Authentication\Tasks;

use App\Containers\Authentication\Adapters\JwtAuthAdapter;
use App\Ship\Task\Abstracts\Task;

/**
 * Class GenerateTokenFromClaimsTask.
 *
 * @author Mahmoud Zalt <mahmoud@zalt.me>
 */
class GenerateTokenFromClaimsTask extends Task
{

    public $jwtAuthAdapter;

    /**
     * GenerateTokenFromClaimsTask constructor.
     *
     * @param \App\Containers\Authentication\Adapters\JwtAuthAdapter $jwtAuthAdapter
     */
    public function __construct(JwtAuthAdapter $jwtAuthAdapter)
    {
        $this->jwtAuthAdapter = $jwtAuthAdapter;
    }


    /**
     * @param $customClaims
     *
     * @return  mixed
     */
    public function run($customClaims)
    {
        return $this->jwtAuthAdapter->makeTokenWithCustomClaims($customClaims);
    }

}
