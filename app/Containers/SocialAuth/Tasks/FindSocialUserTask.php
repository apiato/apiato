<?php

namespace App\Containers\SocialAuth\Tasks;

use App\Containers\User\Data\Repositories\UserRepository;
use App\Ship\Parents\Tasks\Task;

/**
 * Class FindSocialUserTask.
 *
 * @author Mahmoud Zalt <mahmoud@zalt.me>
 */
class FindSocialUserTask extends Task
{

    protected $repository;

    public function __construct(UserRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @param $socialProvider
     * @param $socialId
     *
     * @return  mixed
     */
    public function run($socialProvider, $socialId)
    {
        return $this->repository->findWhere([
            'social_provider' => $socialProvider,
            'social_id'       => $socialId,
        ])->first();
    }

}
