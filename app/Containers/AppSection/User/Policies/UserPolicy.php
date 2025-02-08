<?php

namespace App\Containers\AppSection\User\Policies;

use App\Containers\AppSection\Authorization\Data\Repositories\RoleRepository;
use App\Containers\AppSection\User\Data\Repositories\UserRepository;
use App\Containers\AppSection\User\Models\User;
use App\Ship\Parents\Policies\Policy as ParentPolicy;

class UserPolicy extends ParentPolicy
{
    public function __construct(
        private readonly UserRepository $userRepository,
        private readonly RoleRepository $roleRepository,
    ) {
    }

    public function before(User $user): bool|null
    {
        if ($this->roleRepository->isSuperAdmin($user)) {
            return true;
        }

        return null;
    }

    public function delete(): bool
    {
        return false;
    }

    public function show(): bool
    {
        return false;
    }

    public function index(): bool
    {
        return false;
    }

    public function update(User $user, int $userId): bool
    {
        $entity = $this->userRepository->findById($userId);

        return $user->is($entity);
    }
}
