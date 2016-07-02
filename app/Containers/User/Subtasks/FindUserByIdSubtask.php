<?php

namespace App\Containers\User\Subtasks;

use App\Containers\User\Contracts\UserRepositoryInterface;
use App\Containers\User\Exceptions\UserNotFoundException;
use App\Kernel\Subtask\Abstracts\Subtask;
use Exception;

/**
 * Class FindUserByIdSubtask.
 *
 * @author Mahmoud Zalt <mahmoud@zalt.me>
 */
class FindUserByIdSubtask extends Subtask
{

    /**
     * @var \App\Containers\User\Contracts\UserRepositoryInterface
     */
    private $userRepository;

    /**
     * CreateUserSubtask constructor.
     *
     * @param \App\Containers\User\Contracts\UserRepositoryInterface           $userRepository
     * @param \App\Services\ApiAuthentication\Portals\ApiAuthenticationService $authenticationService
     */
    public function __construct(
        UserRepositoryInterface $userRepository
    ) {
        $this->userRepository = $userRepository;
    }

    /**
     * create a new user object.
     * optionally can login the created user and return it with its token.
     *
     * @param      $email
     * @param      $password
     * @param      $name
     * @param bool $login determine weather to login or not after creating
     *
     * @return mixed
     */
    public function run($id)
    {
        try {
            // find the user by its id
            $user = $this->userRepository->find($id);
        } catch (Exception $e) {
            throw new UserNotFoundException;
        }

        return $user;
    }
}
