<?php

namespace App\Containers\User\Tasks;

use App\Containers\ApiAuthentication\Exceptions\UpdateResourceFailedException;
use App\Containers\User\Contracts\UserRepositoryInterface;
use App\Port\Task\Abstracts\Task;
use Illuminate\Support\Facades\Hash;

/**
 * Class UpdateUserTask.
 *
 * @author Mahmoud Zalt <mahmoud@zalt.me>
 */
class UpdateUserTask extends Task
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
     * @param      $userId
     * @param null $password
     * @param null $name
     * @param null $email
     *
     * @return  mixed
     */
    public function run($userId, $password = null, $name = null, $email = null)
    {
        $attributes = [];

        if ($password) {
            $attributes['password'] = Hash::make($password);
        }

        if ($name) {
            $attributes['name'] = $name;
        }

        if ($email) {
            $attributes['email'] = $email;
        }

        // check if data is empty
        if (!$attributes) {
            throw new UpdateResourceFailedException('Inputs are empty.');
        }

        // updating the attributes
        $user = $this->userRepository->update($attributes, $userId);

        return $user;
    }


}
