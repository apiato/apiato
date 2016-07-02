<?php

namespace App\Containers\User\Subtasks;

use App\Containers\User\Contracts\UserRepositoryInterface;
use App\Services\ApiAuthentication\Exceptions\UpdateResourceFailedException;
use App\Kernel\Subtask\Abstracts\Subtask;

/**
 * Class UpdateUserSubtask.
 *
 * @author Mahmoud Zalt <mahmoud@zalt.me>
 */
class UpdateUserSubtask extends Subtask
{

    /**
     * @var \App\Containers\User\Contracts\UserRepositoryInterface
     */
    private $userRepository;

    /**
     * UpdateUserSubtask constructor.
     *
     * @param \App\Containers\User\Contracts\UserRepositoryInterface $userRepository
     */
    public function __construct(UserRepositoryInterface $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    /**
     * @param      $userId
     * @param null $password
     * @param null $name
     *
     * @return mixed
     */
    public function run($userId, $password = null, $name = null)
    {
        // check if data is empty
        if (!$password && !$name) {
            throw new UpdateResourceFailedException('All inputs are empty.');
        }

        $attributes = [
            'password' => $password,
            'name'     => $name,
        ];

        // updating the attributes
        $user = $this->userRepository->update($attributes, $userId);

        return $user;
    }
}
