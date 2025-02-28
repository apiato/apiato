<?php

namespace App\Containers\AppSection\User\Actions;

use App\Containers\AppSection\User\Data\Collections\UserCollection;
use App\Containers\AppSection\User\Data\Repositories\UserRepository;
use App\Ship\Parents\Actions\Action as ParentAction;
use Illuminate\Pagination\LengthAwarePaginator;

final class ListUsersAction extends ParentAction
{
    public function __construct(
        private readonly UserRepository $repository,
    ) {
    }

    public function run(): LengthAwarePaginator|UserCollection
    {
        return $this->repository->addRequestCriteria()->paginate();
    }
}
