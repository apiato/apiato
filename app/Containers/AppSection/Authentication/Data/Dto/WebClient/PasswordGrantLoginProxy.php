<?php

namespace App\Containers\AppSection\Authentication\Data\Dto\WebClient;

use App\Containers\AppSection\Authentication\Data\Dto\PasswordGrant;

final readonly class PasswordGrantLoginProxy
{
    private function __construct(
        public string $username,
        public string $password,
        public PasswordGrant $grant,
    ) {
    }

    public static function create(string $username, string $password): self
    {
        return new self(
            $username,
            $password,
            PasswordGrant::create(
                (int) config('appSection-authentication.clients.web.id'),
                config('appSection-authentication.clients.web.secret'),
            ),
        );
    }

    public function toArray(): array
    {
        return [
            ...$this->grant->toArray(),
            'username' => $this->username,
            'password' => $this->password,
        ];
    }
}
