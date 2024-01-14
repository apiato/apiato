<?php

namespace App\Containers\AppSection\SocialAuth\Data\Repositories;

use App\Containers\AppSection\SocialAuth\Models\OAuthIdentity;
use Apiato\Core\Abstracts\Repositories\Repository as CoreRepository;

class OAuthIdentityRepository extends CoreRepository
{
    public function model(): string
    {
        return OAuthIdentity::class;
    }
}
