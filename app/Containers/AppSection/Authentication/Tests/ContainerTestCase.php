<?php

namespace App\Containers\AppSection\Authentication\Tests;

use App\Ship\Parents\Tests\PhpUnit\TestCase as ParentTestCase;
use Illuminate\Support\Facades\DB;

class ContainerTestCase extends ParentTestCase
{
    protected function setUp(): void
    {
        parent::setUp();

        $this->createPasswordGrantClient();
        $this->setEnvVars();
    }

    protected const CLIENT_ID = 100;
    protected const CLIENT_SECRET = 'XXp8x4QK7d3J9R7OVRXWrhc19XPRroHTTKIbY8XX';

    protected function createPasswordGrantClient(): void
    {
        DB::table('oauth_clients')->insert([
            'id' => self::CLIENT_ID,
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
        config()->set('appSection-authentication.clients.web.id', self::CLIENT_ID);
        config()->set('appSection-authentication.clients.web.secret', self::CLIENT_SECRET);
    }

    public function enrichWithPasswordGrantFields(string $email, string $password): array
    {
        return [
            'grant_type' => 'password',
            'client_id' => self::CLIENT_ID,
            'client_secret' => self::CLIENT_SECRET,
            'username' => $email,
            'password' => $password,
            'scope' => '',
        ];
    }
}
