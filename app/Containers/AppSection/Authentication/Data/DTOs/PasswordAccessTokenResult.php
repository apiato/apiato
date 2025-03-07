<?php

namespace App\Containers\AppSection\Authentication\Data\DTOs;

use App\Containers\AppSection\User\Models\User;
use Laravel\Passport\Token as PassportToken;

final readonly class PasswordAccessTokenResult
{
    public function __construct(
        private PasswordAccessTokenResponse $response,
        private PassportToken $token,
    ) {
    }

    public function response(): PasswordAccessTokenResponse
    {
        return $this->response;
    }

    public function token(): PassportToken
    {
        return $this->token;
    }

    public function refreshToken(): string
    {
        return $this->response()->refreshToken;
    }

    /**
     * Set the access token as the user's current token.
     */
    public function for(User $user): self
    {
        $user->refresh()->withAccessToken($this->token);

        return $this;
    }
}
