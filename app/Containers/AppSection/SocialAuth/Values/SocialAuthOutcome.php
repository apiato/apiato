<?php

namespace App\Containers\AppSection\SocialAuth\Values;

use Apiato\Core\Abstracts\Models\UserModel;
use Apiato\Core\Abstracts\Values\Value;
use App\Containers\AppSection\SocialAuth\Models\OAuthIdentity;
use Laravel\Passport\PersonalAccessTokenResult;
use Webmozart\Assert\Assert;

class SocialAuthOutcome extends Value
{
    public readonly PersonalAccessTokenResult $token;
    public readonly UserModel $user;

    public function __construct(
        private readonly OAuthIdentity $identity,
    ) {
        Assert::true($this->identity->user()->exists(), 'OAuthIdentity must be linked to a user');

        $this->user = $this->identity->user;
        $this->token = $this->identity->user->createToken('social');
    }
}
