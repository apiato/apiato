<?php

namespace App\Containers\Authentication\UI\API\Tests\Functional;

use App\Containers\Authentication\Tests\ApiTestCase;
use Illuminate\Support\Facades\Config;

class ApiLoginProxyTest extends ApiTestCase
{
    protected $endpoint = 'post@v1/clients/web/admin/login';

    protected $access = [
        'permissions' => '',
        'roles' => '',
    ];

    public function testClientWebAdminProxyLogin(): void
    {
        $data = [
            'email' => 'testing@mail.com',
            'password' => 'testingpass'
        ];

        $user = $this->getTestingUser($data);
        $this->actingAs($user, 'web');

        $response = $this->makeCall($data);

        $response->assertStatus(200);
        $response->assertCookie('refreshToken');
        $this->assertResponseContainKeyValue([
            'token_type' => 'Bearer',
        ]);

        $this->assertResponseContainKeys(['expires_in', 'access_token']);
    }

    public function testClientWebAdminProxyUnconfirmedLogin(): void
    {
        $data = [
            'email' => 'testing2@mail.com',
            'password' => 'testingpass',
            'confirmed' => false,
        ];

        $user = $this->getTestingUser($data);
        $this->actingAs($user, 'web');

        $response = $this->makeCall($data);

        if (Config::get('authentication-container.require_email_confirmation')) {
            $response->assertStatus(409);
        } else {
            $response->assertStatus(200);
        }
    }

    public function testLoginWithNameAttribute(): void
    {
        $data = [
            'email' => 'testing@mail.com',
            'password' => 'testingpass',
            'name' => 'username',
        ];

        $user = $this->getTestingUser($data);
        $this->actingAs($user, 'web');

        // specifically allow to login with "name" attribute
        Config::set('authentication-container.login.attributes',
            [
                'email' => ['email'],
                'name' => [],
            ]
        );

        $request = [
            'password' => 'testingpass',
            'name' => 'username',
        ];

        $response = $this->makeCall($request);

        $response->assertStatus(200);

        $this->assertResponseContainKeyValue([
            'token_type' => 'Bearer',
        ]);

        $this->assertResponseContainKeys(['expires_in', 'access_token', 'refresh_token']);
    }
}
