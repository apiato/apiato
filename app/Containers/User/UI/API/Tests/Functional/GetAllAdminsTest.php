<?php

namespace App\Containers\User\UI\API\Tests\Functional;

use App\Containers\User\Models\User;
use App\Containers\User\Tests\ApiTestCase;

/**
 * Class GetAllUsersTest.
 *
 * @group user
 * @group api
 *
 * @author  Mahmoud Zalt <mahmoud@zalt.me>
 */
class GetAllAdminsTest extends ApiTestCase
{
    protected $endpoint = 'get@v1/admins';

    protected $access = [
        'roles' => '',
        'permissions' => 'list-users',
    ];

    public function testGetAllAdmins_(): void
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
        self::assertCount(3, $responseContent->data); // 2 (fake in this test) + 1 (seeded super admin)
    }

    public function testGetAllAdminsByNonAdmin_(): void
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
