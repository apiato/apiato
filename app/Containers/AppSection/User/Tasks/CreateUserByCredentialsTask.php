<?php

namespace App\Containers\AppSection\User\Tasks;

use App\Containers\AppSection\User\Data\Repositories\UserRepository;
use App\Containers\AppSection\User\Models\User;
use App\Ship\Exceptions\CreateResourceFailedException;
use App\Ship\Parents\Tasks\Task;
use Exception;
use Illuminate\Support\Facades\Hash;

class CreateUserByCredentialsTask extends Task
{
    public function __construct(
        protected UserRepository $repository
    ) {
    }

    /**
     * @throws CreateResourceFailedException
     */
    public function run(array $data, bool $isAdmin = false): User
    {
        if (!array_key_exists('email', $data)) {
            throw new CreateResourceFailedException('email field is required');
        }

        if (!array_key_exists('password', $data)) {
            throw new CreateResourceFailedException('password field is required');
        }

        $data['password'] = Hash::make($data['password']);
        $data['is_admin'] = $isAdmin;

        try {
            $user = $this->repository->create($data);
        } catch (Exception) {
            throw new CreateResourceFailedException();
        }

        return $user;
    }
}
