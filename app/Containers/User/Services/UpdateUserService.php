<?php

namespace App\Containers\User\Services;

use App\Containers\ApiAuthentication\Exceptions\UpdateResourceFailedException;
use App\Containers\User\Contracts\UserRepositoryInterface;
use App\Port\Service\Abstracts\Service;

/**
 * Class UpdateUserService.
 *
 * @author Mahmoud Zalt <mahmoud@zalt.me>
 */
class UpdateUserService extends Service
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
            $attributes['password'] = $password;
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
