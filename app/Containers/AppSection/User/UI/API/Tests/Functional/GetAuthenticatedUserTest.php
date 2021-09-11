<?php

namespace App\Containers\AppSection\User\UI\API\Tests\Functional;

use App\Containers\AppSection\User\Tests\ApiTestCase;

/**
 * Class FindUsersTest.
 *
 * @group user
 * @group api
 */
class GetAuthenticatedUserTest extends ApiTestCase
{
    protected string $endpoint = 'get@v1/user/profile';

    protected array $access = [
        'roles' => '',
        'permissions' => '',
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
            'created_at' => $user->created_at,
            'updated_at' => $user->updated_at,
            'readable_created_at' => $user->created_at->diffForHumans(),
            'readable_updated_at' => $user->updated_at->diffForHumans(),
        ]);
        self::assertEquals($user->name, $responseContent->data->name);
    }
}
