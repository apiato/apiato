<?php

namespace App\Containers\User\Tasks;

use App\Containers\User\Data\Repositories\UserRepository;
use App\Ship\Exceptions\NotFoundException;
use App\Ship\Parents\Tasks\Task;
use Exception;

class FindUserByEmailTask extends Task
{
    protected $repository;

    public function __construct(UserRepository $repository)
    {
        $this->repository = $repository;
    }

    public function run($email)
    {
        // find the user by its email
        try {
            $user = $this->repository->findByField('email', $email)->first();
        } catch (Exception $e) {
            throw new NotFoundException();
        }

        return $user;
    }
}
