<?php

declare(strict_types=1);

namespace App\Containers\AppSection\Authorization\Actions;

use App\Containers\AppSection\Authorization\Data\Collections\RoleCollection;
use App\Containers\AppSection\Authorization\Data\Repositories\RoleRepository;
use App\Ship\Parents\Actions\Action as ParentAction;
use Illuminate\Contracts\Auth\Factory as AuthFactory;
use Illuminate\Contracts\Container\BindingResolutionException;
use Illuminate\Pagination\LengthAwarePaginator;
use Prettus\Repository\Exceptions\RepositoryException;

final class ListRolesAction extends ParentAction
{
    public function __construct(
        private readonly RoleRepository $repository,
        private readonly AuthFactory $authFactory,
    ) {
    }

    /**
     * @throws BindingResolutionException
     * @throws RepositoryException
     */
    public function run(): LengthAwarePaginator|RoleCollection
    {
        $this->repository->addRequestCriteria();
        /** @phpstan-ignore-next-line */
        $this->repository->whereGuard($this->authFactory->activeGuard());

        return $this->repository->paginate();
    }
}
