<?php

namespace App\Containers\AppSection\Authorization\Actions;

use App\Containers\AppSection\Authorization\Tasks\FindRoleTask;
use App\Containers\AppSection\Authorization\UI\API\Requests\ListRolePermissionsRequest;
use App\Ship\Exceptions\NotFoundException;
use App\Ship\Parents\Actions\Action as ParentAction;
use Illuminate\Database\Eloquent\Collection;
use Spatie\Permission\Contracts\Permission;

class ListRolePermissionsAction extends ParentAction
{
    public function __construct(
        private readonly FindRoleTask $findRoleTask,
    ) {
    }

    /**
     * @return Collection<array-key, Permission>
     *
     * @throws NotFoundException
     */
    public function run(ListRolePermissionsRequest $request): Collection
    {
        return $this->findRoleTask->run($request->id)->permissions;
    }
}
