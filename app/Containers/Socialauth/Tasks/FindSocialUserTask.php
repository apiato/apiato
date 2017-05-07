<?php

namespace App\Containers\SocialAuth\Tasks;

use App\Containers\User\Contracts\UserRepositoryInterface;
use App\Ship\Parents\Tasks\Task;


/**
 * Class FindSocialUserTask.
 *
 * @author Mahmoud Zalt <mahmoud@zalt.me>
 */
class FindSocialUserTask extends Task
{

    /**
     * @var \App\Containers\User\Contracts\UserRepositoryInterface
     */
    private $userRepository;

    /**
     * FindSocialUserTask constructor.
     *
     * @param \App\Containers\User\Contracts\UserRepositoryInterface $userRepository
     */
    public function __construct(UserRepositoryInterface $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    /**
     * @param $socialProvider
     * @param $socialId
     *
     * @return  mixed
     */
    public function run($socialProvider, $socialId)
    {
        return $this->userRepository->findWhere([
            'social_provider' => $socialProvider,
            'social_id'       => $socialId,
        ])->first();
    }

}
