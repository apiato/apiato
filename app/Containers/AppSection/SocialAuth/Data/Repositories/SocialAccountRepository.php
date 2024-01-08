<?php

namespace App\Containers\AppSection\SocialAuth\Data\Repositories;

use App\Containers\AppSection\SocialAuth\Models\SocialAccount;
use Apiato\Core\Abstracts\Repositories\Repository as CoreRepository;

class SocialAccountRepository extends CoreRepository
{
    public function model(): string
    {
        return SocialAccount::class;
    }
}
