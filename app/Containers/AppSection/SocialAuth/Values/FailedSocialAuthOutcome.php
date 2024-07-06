<?php

namespace App\Containers\AppSection\SocialAuth\Values;

use Apiato\Core\Abstracts\Values\Value;
use App\Containers\AppSection\SocialAuth\Models\OAuthIdentity;

class FailedSocialAuthOutcome extends Value
{
    public function __construct(
        private readonly OAuthIdentity $identity,
        private readonly string $token,
    ) {
    }

    public function oAuthIdentity(): OAuthIdentity
    {
        return $this->identity;
    }

    /**
     * @return null
     */
    public function user()
    {
        return null;
    }

    public function token(): string
    {
        return $this->token;
    }
}
