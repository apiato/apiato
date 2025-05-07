<?php

namespace App\Containers\AppSection\Authorization\Actions;

use App\Containers\AppSection\Authorization\Data\Collections\RoleCollection;
use App\Containers\AppSection\Authorization\Data\Repositories\RoleRepository;
use App\Ship\Parents\Actions\Action as ParentAction;
use Illuminate\Pagination\LengthAwarePaginator;

final class ListRolesAction extends ParentAction
{
    public function __construct(
        private readonly RoleRepository $repository,
    ) {
    }

    public function run(): LengthAwarePaginator|RoleCollection
    {
        $this->repository->addRequestCriteria();
        $this->repository->whereGuard(auth()->activeGuard());

        return $this->repository->paginate();
    }
}
