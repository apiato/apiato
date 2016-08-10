<?php

namespace App\Containers\User\Services;

use App\Containers\User\Contracts\UserRepositoryInterface;
use App\Port\Service\Abstracts\Service;

/**
 * Class FindUserService.
 *
 * @author Mahmoud Zalt <mahmoud@zalt.me>
 */
class FindUserService extends Service
{

    /**
     * @var \App\Containers\User\Contracts\UserRepositoryInterface
     */
    private $userRepository;

    /**
     * FindUserService constructor.
     *
     * @param \App\Containers\User\Contracts\UserRepositoryInterface $userRepository
     */
    public function __construct(UserRepositoryInterface $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    /**
     * @param $id
     *
     * @return  mixed
     */
    public function byId($id)
    {
        // find the user by its id
        $user = $this->userRepository->find($id);

        return $user;
    }

    /**
     * @param $visitorId
     *
     * @return  mixed
     */
    public function byVisitorId($visitorId)
    {
        $user = $this->userRepository->findByField('visitor_id', $visitorId)->first();

        return $user;
    }

}
