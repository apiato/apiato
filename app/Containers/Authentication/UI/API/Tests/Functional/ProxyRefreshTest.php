<?php

namespace App\Containers\Authentication\UI\API\Tests\Functional;

use App\Containers\Authentication\Exceptions\RefreshTokenMissedException;
use App\Containers\Authentication\Tests\ApiTestCase;
use Config;
use Illuminate\Support\Facades\DB;

/**
 * Class ProxyRefreshTest
 *
 * @group authorization
 * @group api
 *
 * @author  Mahmoud Zalt  <mahmoud@zalt.me>
 */
class ProxyRefreshTest extends ApiTestCase
{

    protected $endpoint = 'post@v1/clients/web/admin/refresh';

    protected $access = [
        'permissions' => '',
        'roles'       => '',
    ];

    private $testingFilesCreated = false;

    /**
     * @test
     */
    public function testRefreshWithoutBeingCreatedOrPassed()
    {
        $user = $this->getTestingUser([
            'email'    => 'testing@mail.com',
            'password' => 'testingpass'
        ]);

        $this->actingAs($user, 'api');

        $clientId = '100';
        $clientSecret = 'XXp8x4QK7d3J9R7OVRXWrhc19XPRroHTTKIbY8XX';

        // create client
        DB::table('oauth_clients')->insert([
            [
                'id'                     => $clientId,
                'secret'                 => $clientSecret,
                'name'                   => 'Testing',
                'redirect'               => 'http://localhost',
                'password_client'        => '1',
                'personal_access_client' => '0',
                'revoked'                => '0',
            ],
        ]);

        // make the clients credentials available as env variables
        Config::set('authentication-container.clients.web.admin.id', $clientId);
        Config::set('authentication-container.clients.web.admin.secret', $clientSecret);

        // create testing oauth keys files
        $publicFilePath = $this->createTestingKey('oauth-public.key');
        $privateFilePath = $this->createTestingKey('oauth-private.key');

        $data = [
            'refresh_token' => null
        ];

        $response = $this->makeCall($data);

        $response->assertStatus(400);

        $message = (new RefreshTokenMissedException())->getMessage();
        $this->assertResponseContainKeyValue(['message' => $message]);

        // delete testing keys files if they were created for this test
        if ($this->testingFilesCreated) {
            unlink($publicFilePath);
            unlink($privateFilePath);
        }
    }

    /**
     * @param $fileName
     *
     * @return  string
     */
    private function createTestingKey($fileName)
    {
        $filePath = storage_path($fileName);

        if (!file_exists($filePath)) {
            $keysStubDirectory = __DIR__ . '/Stubs/';

            copy($keysStubDirectory . $fileName, $filePath);

            $this->testingFilesCreated = true;
        }

        return $filePath;
    }
}
