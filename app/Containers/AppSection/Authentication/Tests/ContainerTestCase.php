<?php

namespace App\Containers\AppSection\Authentication\Tests;

use App\Ship\Parents\Tests\TestCase as ParentTestCase;
use Laravel\Passport\Client;

class ContainerTestCase extends ParentTestCase
{
    private int $clientId;
    private string $clientSecret;

    // TODO
    protected function setupPasswordGrantClient(): void
    {
        $passwordClient = Client::query()
            ->where('password_client', '1')
            ->first();

        $this->clientId = $passwordClient->id;
        $this->clientSecret = $passwordClient->secret;
        $this->setEnvVars();
    }

    private function setEnvVars(): void
    {
        config()->set('appSection-authentication.clients.web.id', $this->clientId);
        config()->set('appSection-authentication.clients.web.secret', $this->clientSecret);
    }
}
