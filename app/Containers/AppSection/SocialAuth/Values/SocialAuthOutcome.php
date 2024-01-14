<?php

namespace App\Containers\AppSection\SocialAuth\Values;

use Apiato\Core\Abstracts\Models\UserModel;
use Apiato\Core\Abstracts\Values\Value;
use App\Containers\AppSection\SocialAuth\Models\OAuthIdentity;
use Laravel\Passport\PersonalAccessTokenResult;

class SocialAuthOutcome extends Value
{
    public readonly PersonalAccessTokenResult $token;
    public readonly UserModel $user;

    public function __construct(
        private readonly OAuthIdentity $identity,
    ) {
        assert($this->identity->user()->exists(), 'OAuthIdentity must have a user');

        $this->user = $this->identity->user;
        $this->token = $this->identity->user->createToken('social');
    }
}
