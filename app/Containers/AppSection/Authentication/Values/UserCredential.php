<?php

namespace App\Containers\AppSection\Authentication\Values;

use App\Ship\Parents\Values\Value as ParentValue;

final readonly class UserCredential extends ParentValue
{
    private function __construct(
        private string $username,
        private string $password,
    ) {
    }

    public static function create(string $username, string $password): self
    {
        return new self($username, $password);
    }

    public function toArray(): array
    {
        return [
            'username' => $this->username,
            'password' => $this->password,
        ];
    }

    public function username(): string
    {
        return $this->username;
    }

    public function password(): string
    {
        return $this->password;
    }
}
