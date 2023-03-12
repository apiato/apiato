<?php

namespace App\Containers\AppSection\Authentication\UI\API\Tests;

use App\Ship\Parents\Tests\PhpUnit\TestCase as ParentTestCase;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;

/**
 * Class ApiTestCase.
 *
 * Use this class to add your container specific API related test helper functions.
 */
class ApiTestCase extends ParentTestCase
{
    private bool $testingFilesCreated = false;
    private string $publicFilePath;
    private string $privateFilePath;

    protected function setUp(): void
    {
        parent::setUp();

        $clientId = '100';
        $clientSecret = 'XXp8x4QK7d3J9R7OVRXWrhc19XPRroHTTKIbY8XX';

        // create password grand client
        DB::table('oauth_clients')->insert([
            [
                'id' => $clientId,
                'secret' => $clientSecret,
                'name' => 'Testing',
                'redirect' => 'http://localhost',
                'password_client' => '1',
                'personal_access_client' => '0',
                'revoked' => '0',
            ],
        ]);

        // make the clients credentials available as env variables
        Config::set('appSection-authentication.clients.web.id', $clientId);
        Config::set('appSection-authentication.clients.web.secret', $clientSecret);

        // create testing oauth keys files
        $this->publicFilePath = $this->createTestingKey('oauth-public.key');
        $this->privateFilePath = $this->createTestingKey('oauth-private.key');
    }

    private function createTestingKey($fileName): string
    {
        $filePath = storage_path($fileName);

        if (!file_exists($filePath)) {
            $keysStubDirectory = __DIR__ . '/Functional/Stubs/';

            copy($keysStubDirectory . $fileName, $filePath);

            $this->testingFilesCreated = true;
        }

        return $filePath;
    }

    protected function tearDown(): void
    {
        parent::tearDown();

        // delete testing keys files if they were created for this test
        if ($this->testingFilesCreated) {
            unlink($this->publicFilePath);
            unlink($this->privateFilePath);
        }
    }
}
