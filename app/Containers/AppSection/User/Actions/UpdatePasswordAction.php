<?php

namespace App\Containers\AppSection\User\Actions;

use App\Containers\AppSection\User\Data\Resources\UserResource;
use App\Containers\AppSection\User\Models\User;
use App\Containers\AppSection\User\Notifications\PasswordUpdatedNotification;
use App\Containers\AppSection\User\Tasks\UpdateUserTask;
use App\Ship\Exceptions\NotFoundException;
use App\Ship\Exceptions\UpdateResourceFailedException;
use App\Ship\Parents\Actions\Action as ParentAction;

class UpdatePasswordAction extends ParentAction
{
    public function __construct(
        private readonly UpdateUserTask $updateUserTask,
    ) {
    }

    /**
     * @throws NotFoundException
     * @throws UpdateResourceFailedException
     */
    public function run(UserResource $data): User
    {
        $user = $this->updateUserTask->run($data);

        $user->notify(new PasswordUpdatedNotification());

        return $user;
    }
}
