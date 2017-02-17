<?php

namespace App\Containers\User\Tasks;

use App\Containers\User\Data\Repositories\UserRepository;
use App\Ship\Parents\Actions\Action;

/**
 * Class CountAllUsersTask.
 *
 * @author Mahmoud Zalt <mahmoud@zalt.me>
 */
class CountAllUsersTask extends Action
{

    /**
     * CountUsersAction constructor.
     *
     * @param \App\Containers\User\Data\Repositories\UserRepository $userRepository
     */
    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    /**
     * @return  mixed
     */
    public function run()
    {
        return $this->userRepository->all()->count();
    }

}
