<?php

namespace App\Containers\Email\Services;

use App\Containers\User\Contracts\UserRepositoryInterface;
use App\Containers\User\Exceptions\UserNotFoundException;
use App\Ship\Service\Abstracts\Service;

/**
 * Class SetUserEmailService.
 *
 * @author Mahmoud Zalt <mahmoud@zalt.me>
 */
class SetUserEmailService extends Service
{

    /**
     * @var \App\Containers\User\Contracts\UserRepositoryInterface
     */
    private $userRepository;

    /**
     * UpdateUserService constructor.
     *
     * @param \App\Containers\User\Contracts\UserRepositoryInterface $userRepository
     */
    public function __construct(UserRepositoryInterface $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    /**
     * @param $userId
     * @param $email
     *
     * @return  mixed
     */
    public function run($userId, $email)
    {
        $user = $this->userRepository->find($userId);

        if (!$user) {
            throw new UserNotFoundException;
        }

        $user->email = $email;
        $user->save();

        return $user;
    }
}
