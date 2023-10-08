<?php

namespace App\Containers\AppSection\User\Tasks;

use App\Containers\AppSection\User\Data\Repositories\UserRepository;
use App\Containers\AppSection\User\Models\User;
use App\Ship\Exceptions\NotFoundException;
use App\Ship\Exceptions\UpdateResourceFailedException;
use App\Ship\Parents\Tasks\Task as ParentTask;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\Hash;

class UpdateUserTask extends ParentTask
{
    public function __construct(
        protected readonly UserRepository $repository
    ) {
    }

    /**
     * @throws NotFoundException
     * @throws UpdateResourceFailedException
     */
    public function run(array $userData, $userId): User
    {
        try {
            if (array_key_exists('password', $userData)) {
                $userData['password'] = Hash::make($userData['password']);
            }

            return $this->repository->update($userData, $userId);
        } catch (ModelNotFoundException) {
            throw new NotFoundException();
        } catch (\Exception) {
            throw new UpdateResourceFailedException();
        }
    }
}
