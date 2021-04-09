<?php

namespace App\Containers\AppSection\Authentication\UI\API\Tests\Functional;

use App\Containers\AppSection\Authentication\Exceptions\RefreshTokenMissedException;
use App\Containers\AppSection\Authentication\Tests\ApiTestCase;

/**
 * Class ApiRefreshProxyTest
 *
 * @group authentication
 * @group api
 */
class ApiRefreshProxyTest extends ApiTestCase
{
    protected string $endpoint = 'post@v1/clients/web/refresh';

    protected array $access = [
        'permissions' => '',
        'roles' => '',
    ];

    private array $data;

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
        $loginResponse = $this->endpoint('post@v1/clients/web/login')->makeCall($this->data);
        $refreshToken = json_decode($loginResponse->getContent(), true, 512, JSON_THROW_ON_ERROR)['refresh_token'];
        $data = [
            'refresh_token' => $refreshToken
        ];

        $response = $this->endpoint($this->endpoint)->makeCall($data);

        $response->assertStatus(200);
        $this->assertResponseContainKeyValue([
            'token_type' => 'Bearer',
        ]);
        $this->assertResponseContainKeys(['expires_in', 'access_token']);
    }
}
