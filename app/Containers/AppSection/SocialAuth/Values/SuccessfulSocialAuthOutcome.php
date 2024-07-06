<?php

namespace App\Containers\AppSection\SocialAuth\Values;

use Apiato\Core\Abstracts\Models\UserModel;
use Apiato\Core\Abstracts\Values\Value;
use App\Containers\AppSection\SocialAuth\Models\OAuthIdentity;
use Laravel\Passport\PersonalAccessTokenResult;

class SuccessfulSocialAuthOutcome extends Value
{
    private readonly PersonalAccessTokenResult $token;
    private readonly UserModel $user;

    public function __construct(
        private readonly OAuthIdentity $identity,
    ) {
        $this->user = $this->identity->user;
        $this->token = $this->identity->user?->createToken('social');
    }

    public function oAuthIdentity(): OAuthIdentity
    {
        return $this->identity;
    }

    public function user(): UserModel
    {
        return $this->user;
    }

    public function token(): PersonalAccessTokenResult
    {
        return $this->token;
    }
}
