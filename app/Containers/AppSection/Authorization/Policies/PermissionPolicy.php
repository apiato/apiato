<?php

namespace App\Containers\AppSection\Authorization\Policies;

use App\Containers\AppSection\Authorization\Data\Repositories\RoleRepository;
use App\Containers\AppSection\User\Models\User;
use App\Ship\Parents\Policies\Policy as ParentPolicy;

final class PermissionPolicy extends ParentPolicy
{
    public function __construct(
        private readonly RoleRepository $repository,
    ) {
    }

    public function give(User $user): bool
    {
        return $this->repository->isSuperAdmin($user);
    }

    public function view(User $user): bool
    {
        return $this->repository->isSuperAdmin($user);
    }

    public function viewAny(User $user): bool
    {
        return $this->repository->isSuperAdmin($user);
    }

    public function revoke(User $user): bool
    {
        return $this->repository->isSuperAdmin($user);
    }

    public function sync(User $user): bool
    {
        return $this->repository->isSuperAdmin($user);
    }
}
