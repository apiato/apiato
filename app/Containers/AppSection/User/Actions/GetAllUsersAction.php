<?php

namespace App\Containers\AppSection\User\Actions;

use App\Containers\AppSection\User\Tasks\GetAllUsersTask;
use App\Ship\Parents\Actions\Action;
use Prettus\Repository\Exceptions\RepositoryException;

class GetAllUsersAction extends Action
{
    /**
     * @throws RepositoryException
     */
    public function run()
    {
        return app(GetAllUsersTask::class)->addRequestCriteria()->ordered()->run();
    }
}
