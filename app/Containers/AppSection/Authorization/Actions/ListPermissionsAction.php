<?php

namespace App\Containers\AppSection\Authorization\Actions;

use App\Containers\AppSection\Authorization\Data\Collections\PermissionCollection;
use App\Containers\AppSection\Authorization\Data\Repositories\PermissionRepository;
use App\Ship\Parents\Actions\Action as ParentAction;
use Illuminate\Pagination\LengthAwarePaginator;

final class ListPermissionsAction extends ParentAction
{
    public function __construct(
        private readonly PermissionRepository $repository,
    ) {
    }

    public function run(): LengthAwarePaginator|PermissionCollection
    {
        $this->repository->addRequestCriteria();
        $this->repository->whereGuard(auth()->activeGuard());

        return $this->repository->paginate();
    }
}
