<?php

namespace App\Containers\AppSection\Authentication\UI\API\Tests\Functional;

use App\Containers\AppSection\Authentication\UI\API\Tests\ApiTestCase;
use App\Containers\AppSection\User\Models\User;

/**
 * Class GetAuthenticatedUserTest.
 *
 * @group authentication
 * @group api
 */
class GetAuthenticatedUserTest extends ApiTestCase
{
    protected string $endpoint = 'get@v1/profile';

    protected array $access = [
        'permissions' => '',
        'roles' => '',
    ];

    public function testGetAuthenticatedUser(): void
    {
        $user = $this->getTestingUser();

        $response = $this->makeCall();

        $response->assertStatus(200);
        $responseContent = $this->getResponseContentObject();
        $this->assertResponseContainKeyValue([
            'object' => 'User',
            'id' => $user->getHashedKey(),
            'email' => $user->email,
            'email_verified_at' => $user->email_verified_at,
            'name' => $user->name,
            'gender' => $user->gender,
            'birth' => $user->birth,
        ]);
        $this->assertEquals($user->name, $responseContent->data->name);
    }

    public function testGetAuthenticatedUserAsAdmin(): void
    {
        $user = $this->getTestingUser(createUserAsAdmin: true);

        $response = $this->makeCall();

        $response->assertStatus(200);
        $responseContent = $this->getResponseContentObject();
        $this->assertResponseContainKeyValue([
            'object' => 'User',
            'id' => $user->getHashedKey(),
            'email' => $user->email,
            'email_verified_at' => $user->email_verified_at,
            'name' => $user->name,
            'gender' => $user->gender,
            'birth' => $user->birth,
            'real_id' => $user->id,
            'created_at' => $user->created_at,
            'updated_at' => $user->updated_at,
            'readable_created_at' => $user->created_at->diffForHumans(),
            'readable_updated_at' => $user->updated_at->diffForHumans(),
        ]);
        $this->assertEquals($user->name, $responseContent->data->name);
    }

    public function testGetAuthenticatedUser_ByUnauthenticatedUser(): void
    {
        $this->testingUser = User::factory()->create();

        $response = $this->auth(false)->makeCall();

        $response->assertStatus(401);
    }
}
