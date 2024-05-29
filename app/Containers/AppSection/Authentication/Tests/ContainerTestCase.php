<?php

namespace App\Containers\AppSection\Authentication\Tests;

use App\Ship\Parents\Tests\TestCase as ParentTestCase;
use Laravel\Passport\Client;

class ContainerTestCase extends ParentTestCase
{
    protected const CLIENT_SECRET = 'XXp8x4QK7d3J9R7OVRXWrhc19XPRroHTTKIbY8XX';
    private int $clientId;

    public function enrichWithPasswordGrantFields(string $email, string $password): array
    {
        return [
            'grant_type' => 'password',
            'client_id' => $this->clientId,
            'client_secret' => self::CLIENT_SECRET,
            'username' => $email,
            'password' => $password,
            'scope' => '',
        ];
    }

    protected function setUp(): void
    {
        parent::setUp();

        $this->clientId = $this->createPasswordGrantClient()->id;

        $this->setEnvVars();
    }

    protected function createPasswordGrantClient(): Client
    {
        return Client::create([
            'secret' => self::CLIENT_SECRET,
            'name' => 'Testing',
            'redirect' => 'http://localhost',
            'password_client' => '1',
            'personal_access_client' => '0',
            'revoked' => '0',
        ]);
    }

    protected function setEnvVars(): void
    {
        config()->set('appSection-authentication.clients.web.id', $this->clientId);
        config()->set('appSection-authentication.clients.web.secret', self::CLIENT_SECRET);
    }
}
