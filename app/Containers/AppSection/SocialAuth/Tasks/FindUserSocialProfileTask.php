<?php

namespace App\Containers\AppSection\SocialAuth\Tasks;

use Apiato\Core\Abstracts\Tasks\Task;
use App\Containers\AppSection\SocialAuth\Contracts\SocialAuthProvider;

class FindUserSocialProfileTask extends Task
{
    public function run(SocialAuthProvider $provider)
    {
        return $provider->getUser();
    }
}
