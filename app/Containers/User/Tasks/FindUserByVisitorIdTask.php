<?php

namespace App\Containers\User\Tasks;

use App\Containers\Authentication\Exceptions\MissingVisitorIdException;
use App\Containers\User\Contracts\UserRepositoryInterface;
use App\Port\Task\Abstracts\Task;

/**
 * Class FindUserByVisitorIdTask.
 *
 * @author Mahmoud Zalt <mahmoud@zalt.me>
 */
class FindUserByVisitorIdTask extends Task
{

    /**
     * @var \App\Containers\User\Contracts\UserRepositoryInterface
     */
    private $userRepository;

    /**
     * FindUserByVisitorIdTask constructor.
     *
     * @param \App\Containers\User\Contracts\UserRepositoryInterface $userRepository
     */
    public function __construct(UserRepositoryInterface $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    /**
     * @param      $visitorId
     * @param bool $skipCriterias
     *
     * @return  mixed
     */
    public function run($visitorId, $skipCriterias = false)
    {
        if (!$visitorId) {
            throw (new MissingVisitorIdException());
        }

        if($skipCriterias){
            $this->userRepository = $this->userRepository->skipCriteria();
        }

        $user = $this->userRepository->findByField('visitor_id', $visitorId)->first();

        return $user;
    }

}
