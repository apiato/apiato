<?php

namespace App\Containers\AppSection\SocialAuth\Values;

use Apiato\Core\Abstracts\Models\UserModel;
use Apiato\Core\Abstracts\Values\Value;
use Laravel\Passport\PersonalAccessTokenResult;

class SocialAuthOutcome extends Value
{
    public function __construct(
        public readonly UserModel $user,
        public readonly PersonalAccessTokenResult $token,
    ) {
    }
}
