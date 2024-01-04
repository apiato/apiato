<?php

namespace App\Containers\AppSection\SocialAuth\Tasks;

use Apiato\Core\Abstracts\Tasks\Task;

class FindSocialUserTask extends Task
{
    private mixed $repository;

    public function __construct()
    {
        $this->repository = app(config('vendor-socialAuth.user.repository'));
    }

    public function run($socialProvider, $socialId)
    {
        return $this->repository->findWhere([
            'social_provider' => $socialProvider,
            'social_id' => $socialId,
        ])->first();
    }
}
