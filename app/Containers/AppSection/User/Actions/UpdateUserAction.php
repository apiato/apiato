<?php

namespace App\Containers\AppSection\User\Actions;

use App\Containers\AppSection\User\Models\User;
use App\Containers\AppSection\User\Tasks\UpdateUserTask;
use App\Ship\Exceptions\ResourceNotFound;
use App\Ship\Parents\Actions\Action as ParentAction;
use Prettus\Validator\Exceptions\ValidatorException;

final class UpdateUserAction extends ParentAction
{
    public function __construct(
        private readonly UpdateUserTask $updateUserTask,
    ) {
    }

    /**
     * @throws ResourceNotFound
     * @throws ValidatorException
     */
    public function run(int $id, array $data): User
    {
        $data['password'] = $data['new_password'];

        return $this->updateUserTask->run($id, $data);
    }
}
