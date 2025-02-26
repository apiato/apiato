<?php

namespace App\Containers\AppSection\Authentication\Values\Clients;

// TODO: maybe we can rename this to App? Because WebClient is actually our Web App client credentials
interface Client
{
    public function toArray(): array;

    public function id(): int;

    public function secret(): string;
}
