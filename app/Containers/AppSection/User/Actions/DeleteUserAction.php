<?php

namespace App\Containers\AppSection\User\Actions;

use App\Containers\AppSection\User\Data\Repositories\UserRepository;
use App\Containers\AppSection\User\Exceptions\FailedToDeleteUser;
use App\Ship\Parents\Actions\Action as ParentAction;

final class DeleteUserAction extends ParentAction
{
    public function __construct(
        private readonly UserRepository $repository,
    ) {
    }

    public function run(int $id): bool
    {
        $user = $this->repository->findById($id);

        if (auth()->user()?->is($user)) {
            throw FailedToDeleteUser::becauseCannotDeleteItself();
        }

        return $this->repository->delete($id);
    }
}
