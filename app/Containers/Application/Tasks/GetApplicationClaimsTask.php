<?php

namespace App\Containers\Application\Tasks;

use App\Containers\Application\Models\Application;
use App\Port\Task\Abstracts\Task;

/**
 * Class GetApplicationClaimsTask.
 *
 * @author Mahmoud Zalt <mahmoud@zalt.me>
 */
class GetApplicationClaimsTask extends Task
{

    /**
     * @param \App\Containers\Application\Models\Application $app
     *
     * @return  array
     */
    public function run(Application $app)
    {
        $customClaims = ['ApplicationId' => $app->id];

        return $customClaims;
    }

}
