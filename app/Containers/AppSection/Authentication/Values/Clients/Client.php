<?php

namespace App\Containers\AppSection\Authentication\Values\Clients;

interface Client
{
    public function id(): mixed;

    public function plainSecret(): string;

    public function instance(): \Laravel\Passport\Client;
}
