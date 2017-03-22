<?php

namespace App\Containers\User\Tasks;

use App\Containers\User\Contracts\UserRepositoryInterface;
use App\Ship\Parents\Actions\Action;

/**
 * Class DeleteUserTask.
 *
 * @author Mahmoud Zalt <mahmoud@zalt.me>
 */
class DeleteUserTask extends Action
{

    /**
     * @var \App\Containers\User\Contracts\UserRepositoryInterface
     */
    private $userRepository;

    /**
     * UpdateUserAction constructor.
     *
     * @param \App\Containers\User\Contracts\UserRepositoryInterface $userRepository
     */
    public function __construct(UserRepositoryInterface $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    /**
     * @param $userId
     *
     * @return bool
     */
    public function run($user)
    {
        // delete the record from the users table.
        $this->userRepository->delete($user->id);

        return true;
    }
}
