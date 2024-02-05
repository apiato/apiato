<?php

namespace App\Containers\AppSection\Authorization\Actions;

use App\Containers\AppSection\Authorization\UI\API\Requests\ListUserPermissionsRequest;
use App\Containers\AppSection\User\Tasks\FindUserByIdTask;
use App\Ship\Exceptions\NotFoundException;
use App\Ship\Parents\Actions\Action as ParentAction;
use Illuminate\Database\Eloquent\Collection;
use Spatie\Permission\Contracts\Permission;

class ListUserPermissionsAction extends ParentAction
{
    public function __construct(
        private readonly FindUserByIdTask $findUserByIdTask,
    ) {
    }

    /**
     * @return Collection<array-key, Permission>
     *
     * @throws NotFoundException
     */
    public function run(ListUserPermissionsRequest $request): Collection
    {
        return $this->findUserByIdTask->run($request->id)->permissions;
    }
}
