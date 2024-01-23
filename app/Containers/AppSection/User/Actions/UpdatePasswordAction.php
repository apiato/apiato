<?php

namespace App\Containers\AppSection\User\Actions;

use Apiato\Core\Exceptions\IncorrectIdException;
use App\Containers\AppSection\User\Models\User;
use App\Containers\AppSection\User\Notifications\PasswordUpdatedNotification;
use App\Containers\AppSection\User\Tasks\UpdateUserTask;
use App\Containers\AppSection\User\UI\API\Requests\UpdatePasswordRequest;
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
     * @throws IncorrectIdException
     * @throws NotFoundException
     * @throws UpdateResourceFailedException
     */
    public function run(UpdatePasswordRequest $request): User
    {
        $sanitizedData = $request->sanitizeInput([
            'new_password',
        ]);

        $user = $this->updateUserTask->run($request->id, ['password' => $sanitizedData['new_password']]);

        $user->notify(new PasswordUpdatedNotification());

        return $user;
    }
}
