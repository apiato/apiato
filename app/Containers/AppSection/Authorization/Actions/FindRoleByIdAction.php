<?php

declare(strict_types=1);

namespace App\Containers\AppSection\Authorization\Actions;

use App\Containers\AppSection\Authorization\Models\Role;
use App\Containers\AppSection\Authorization\Tasks\FindRoleTask;
use App\Containers\AppSection\Authorization\UI\API\Requests\FindRoleByIdRequest;
use App\Ship\Exceptions\NotFoundException;
use App\Ship\Parents\Actions\Action as ParentAction;

class FindRoleByIdAction extends ParentAction
{
    public function __construct(private readonly FindRoleTask $findRoleTask)
    {
    }

    /**
     * @throws NotFoundException
     */
    public function run(FindRoleByIdRequest $request): Role
    {
        return $this->findRoleTask->run($request->role_id);
    }
}
