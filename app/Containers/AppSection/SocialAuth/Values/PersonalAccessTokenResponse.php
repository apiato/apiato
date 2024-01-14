<?php

namespace App\Containers\AppSection\SocialAuth\Values;

use Apiato\Core\Abstracts\Values\Value;
use Laravel\Passport\PersonalAccessTokenResult;

final class PersonalAccessTokenResponse extends Value
{
    private function __construct(
        private readonly PersonalAccessTokenResult $token,
    ) {
    }

    public function toArray(): array
    {
        return [
            'token_type' => 'personal',
            'access_token' => $this->token->accessToken,
            'expires_in' => $this->token->token->expires_at->diffInSeconds(),
        ];
    }

    public static function from(PersonalAccessTokenResult $token): self
    {
        return new self($token);
    }
}
