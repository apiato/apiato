<?php

namespace App\Containers\AppSection\Authorization\Policies;

use App\Containers\AppSection\Authorization\Data\Repositories\RoleRepository;
use App\Containers\AppSection\User\Models\User;
use App\Ship\Parents\Policies\Policy as ParentPolicy;

final class RolePolicy extends ParentPolicy
{
    public function __construct(
        private readonly RoleRepository $repository,
    ) {
    }

    public function assign(User $user): bool
    {
        return $this->repository->isSuperAdmin($user);
    }

    public function create(User $user): bool
    {
        return $this->repository->isSuperAdmin($user);
    }

    public function delete(User $user): bool
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
