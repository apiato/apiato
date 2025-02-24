<?php

namespace App\Containers\AppSection\Authorization\Actions;

use App\Containers\AppSection\Authorization\Data\Repositories\RoleRepository;
use App\Ship\Exceptions\ResourceNotFound;
use App\Ship\Parents\Actions\Action as ParentAction;

final class DeleteRoleAction extends ParentAction
{
    public function __construct(
        private readonly RoleRepository $repository,
    ) {
    }

    /**
     * @throws ResourceNotFound
     */
    public function run(int $id): bool
    {
        return $this->repository->delete($id);
    }
}
