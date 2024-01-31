<?php

namespace App\Containers\AppSection\SocialAuth\Actions;

use Apiato\Core\Abstracts\Actions\Action;
use App\Containers\AppSection\SocialAuth\Data\Repositories\OAuthIdentityRepository;

final class IndexOAuthIdentitiesAction extends Action
{
    public function __construct(
        private readonly OAuthIdentityRepository $repository,
    ) {
    }

    public function run(int $userId): array
    {
        return $this->repository->findWhere(['user_id' => $userId])->all();
    }
}
