<?php

namespace App\Containers\AppSection\SocialAuth\Data\Repositories;

use Apiato\Core\Abstracts\Repositories\Repository as CoreRepository;
use App\Containers\AppSection\SocialAuth\Models\OAuthIdentity;

class OAuthIdentityRepository extends CoreRepository
{
    public function model(): string
    {
        return OAuthIdentity::class;
    }
}
