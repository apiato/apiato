<?php

namespace App\Containers\AppSection\Authentication\Data\Dto\WebClient;

use App\Containers\AppSection\Authentication\Data\Dto\RefreshTokenGrant;

final readonly class RefreshProxy
{
    public function __construct(
        public string|null $refreshToken,
        public RefreshTokenGrant $grant,
    ) {
    }

    public static function create(string $refreshToken): self
    {
        return new self(
            $refreshToken,
            RefreshTokenGrant::create(
                (int) config('appSection-authentication.clients.web.id'),
                config('appSection-authentication.clients.web.secret'),
            ),
        );
    }

    public function toArray(): array
    {
        return [
            ...$this->grant->toArray(),
            'refresh_token' => $this->refreshToken,
        ];
    }
}
