<?php

namespace App\Containers\AppSection\Authentication\Tests;

use App\Containers\AppSection\Authentication\Tasks\CallOAuthServerTask;
use App\Ship\Parents\Tests\PhpUnit\TestCase as ParentTestCase;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;

/**
 * Class UnitTestCase.
 *
 * Use this class to add your container specific unit test helper functions.
 */
class UnitTestCase extends ParentTestCase
{
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
        $this->createTestingKey('oauth-public.key');
        $this->createTestingKey('oauth-private.key');
    }

    private function createTestingKey($fileName): void
    {
        $filePath = storage_path($fileName);

        if (!file_exists($filePath)) {
            $keysStubDirectory = __DIR__ . '/Stubs/';

            copy($keysStubDirectory . $fileName, $filePath);

            $this->testingFilesCreated = true;
        }
    }

    protected function createRefreshToken($email, $password)
    {
        return app(CallOAuthServerTask::class)->run($this->createRequestData($email, $password))['refresh_token'];
    }

    protected function createRequestData($email, $password): array
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

    protected function createAccessToken($email, $password)
    {
        return app(CallOAuthServerTask::class)->run($this->createRequestData($email, $password))['access_token'];
    }
}
