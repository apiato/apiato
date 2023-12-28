<?php

namespace App\Containers\AppSection\Authentication\Tests;

use App\Containers\AppSection\Authentication\Tasks\CallOAuthServerTask;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;

class UnitTestCase extends ContainerTestCase
{
    private const OAUTH_PUBLIC_KEY = 'oauth-public.key';
    private const OAUTH_PRIVATE_KEY = 'oauth-private.key';
    protected string $clientId;
    protected string $clientSecret;
    private bool $testingFilesCreated = false;

    protected function setUp(): void
    {
        parent::setUp();

        $this->clientId = '200';
        $this->clientSecret = 'XXp8x4QK7d3J9R7OVRXWrhc19XPRroHTTKIbY8XX';

        // create client
        DB::table('oauth_clients')->insert([
            [
                'id' => $this->clientId,
                'secret' => $this->clientSecret,
                'name' => 'Testing',
                'redirect' => 'http://localhost',
                'password_client' => '1',
                'personal_access_client' => '0',
                'revoked' => '0',
            ],
        ]);

        // make the clients credentials available as env variables
        Config::set('appSection-authentication.clients.web.id', $this->clientId);
        Config::set('appSection-authentication.clients.web.secret', $this->clientSecret);

        // create testing oauth keys files
        $this->createTestingKey(self::OAUTH_PUBLIC_KEY);
        $this->createTestingKey(self::OAUTH_PRIVATE_KEY);
    }

    private function createTestingKey(string $fileName): void
    {
        $filePath = storage_path($fileName);

        if (!file_exists($filePath)) {
            $keysStubDirectory = __DIR__ . '/Stubs/';

            copy($keysStubDirectory . $fileName, $filePath);

            $this->testingFilesCreated = true;
        }
    }

    protected function createRefreshToken(string $email, string $password): string
    {
        return app(CallOAuthServerTask::class)->run($this->createRequestData($email, $password))['refresh_token'];
    }

    protected function createRequestData(string $email, string $password): array
    {
        return [
            'grant_type' => 'password',
            'client_id' => $this->clientId,
            'client_secret' => $this->clientSecret,
            'username' => $email,
            'password' => $password,
            'scope' => '',
        ];
    }

    protected function createAccessToken(string $email, string $password): string
    {
        return app(CallOAuthServerTask::class)->run($this->createRequestData($email, $password))['access_token'];
    }
}
