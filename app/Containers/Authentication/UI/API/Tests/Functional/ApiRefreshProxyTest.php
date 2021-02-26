<?php

namespace App\Containers\Authentication\UI\API\Tests\Functional;

use App\Containers\Authentication\Exceptions\RefreshTokenMissedException;
use App\Containers\Authentication\Tests\ApiTestCase;

class ApiRefreshProxyTest extends ApiTestCase
{
    protected $endpoint = 'post@v1/clients/web/admin/refresh';

    protected $access = [
        'permissions' => '',
        'roles' => '',
    ];

    private $data;

    public function setUp(): void
    {
        parent::setUp();

        $this->data = [
            'email' => 'testing@mail.com',
            'password' => 'testing_pass'
        ];

        $this->getTestingUser($this->data);
        $this->actingAs($this->testingUser, 'web');
    }

    public function testRequestingRefreshTokenWithoutPassingARefreshTokenShouldThrowAnException(): void
    {
        $data = [
            'refresh_token' => null
        ];

        $response = $this->makeCall($data);

        $response->assertStatus(400);
        $message = (new RefreshTokenMissedException())->getMessage();
        $this->assertResponseContainKeyValue(['message' => $message]);
    }

    public function testOnSuccessfulRefreshTokenRequestEnsureValuesAreSetProperly(): void
    {
        $loginResponse = $this->endpoint('post@v1/clients/web/admin/login')->makeCall($this->data);
        $refreshToken = json_decode($loginResponse->getContent(), true, 512, JSON_THROW_ON_ERROR)['refresh_token'];

        $data = [
            'refresh_token' => $refreshToken
        ];

        $response = $this->endpoint($this->endpoint)->makeCall($data);

        $response->assertStatus(200);
        $response->assertCookie('refreshToken');
        $this->assertResponseContainKeyValue([
            'token_type' => 'Bearer',
        ]);

        $this->assertResponseContainKeys(['expires_in', 'access_token']);
    }
}
