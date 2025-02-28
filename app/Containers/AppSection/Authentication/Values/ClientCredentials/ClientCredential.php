<?php

namespace App\Containers\AppSection\Authentication\Values\ClientCredentials;

interface ClientCredential
{
    public function toArray(): array;

    public function id(): int;

    public function secret(): string;
}
