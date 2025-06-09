<?php

declare(strict_types=1);

namespace App\Containers\AppSection\Authorization\Actions;

use App\Containers\AppSection\Authorization\Data\Collections\PermissionCollection;
use App\Containers\AppSection\Authorization\Data\Repositories\PermissionRepository;
use App\Ship\Parents\Actions\Action as ParentAction;
use Illuminate\Contracts\Auth\Factory as AuthFactory;
use Illuminate\Contracts\Container\BindingResolutionException;
use Illuminate\Pagination\LengthAwarePaginator;
use Prettus\Repository\Exceptions\RepositoryException;

final class ListPermissionsAction extends ParentAction
{
    public function __construct(
        private readonly PermissionRepository $repository,
        private readonly AuthFactory $authFactory,
    ) {
    }

    /**
     * @throws BindingResolutionException
     * @throws RepositoryException
     */
    public function run(): LengthAwarePaginator|PermissionCollection
    {
        $this->repository->addRequestCriteria();
        /** @phpstan-ignore-next-line */
        $this->repository->whereGuard($this->authFactory->activeGuard());

        return $this->repository->paginate();
    }
}
