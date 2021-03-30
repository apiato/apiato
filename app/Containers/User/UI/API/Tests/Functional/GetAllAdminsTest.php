<?php

namespace App\Containers\User\UI\API\Tests\Functional;

use App\Containers\User\Models\User;
use App\Containers\User\Tests\ApiTestCase;

/**
 * Class GetAllUsersTest.
 *
 * @group user
 * @group api
 */
class GetAllAdminsTest extends ApiTestCase
{
    protected string $endpoint = 'get@v1/admins';

    protected array $access = [
        'roles' => '',
        'permissions' => 'list-users',
    ];

    public function testGetAllAdmins(): void
    {
        User::factory()->count(1)->create();
        User::factory()->count(1)->admin()->create();

        // send the HTTP request
        $response = $this->makeCall();

        // assert response status is correct
        $response->assertStatus(200);

        // convert JSON response string to Object
        $responseContent = $this->getResponseContentObject();

        // assert the returned data size is correct
        // 1 + 1 (seeded super admin)
        self::assertCount(2, $responseContent->data);
    }

    public function testGetAllAdminsByNonAdmin(): void
    {
        $this->getTestingUserWithoutAccess();

        // create some fake users
        User::factory()->count(2)->create();

        // send the HTTP request
        $response = $this->makeCall();
        // assert response status is correct
        $response->assertStatus(403);

        $this->assertResponseContainKeyValue([
            'message' => 'This action is unauthorized.',
        ]);
    }
}
