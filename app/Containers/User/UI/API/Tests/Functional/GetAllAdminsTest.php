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
        'roles'       => '',
        'permissions' => 'list-users',
    ];

    /**
     * @test
     */
    public function testGetAllAdmins_()
    {
        $currentUserCount = User::where('is_client', 0)->get()->count();

        // create some admin users
        $createdAdminUsers = factory(User::class, 4)->create();

        // create some non-admin users
        factory(User::class, 3)->states('client')->create();

        // send the HTTP request
        $response = $this->makeCall();

        // assert response status is correct
        $response->assertStatus(200);

        // convert JSON response string to Object
        $responseContent = $this->getResponseContentObject();

        // assert admin count before seeding + amount of admin users seeded equals total admin count
        $this->assertCount($currentUserCount + $createdAdminUsers->count(),
            $responseContent->data); 
    }

    /**
     * @test
     */
    public function testGetAllAdminsByNonAdmin_()
    {
        $this->getTestingUserWithoutAccess();

        // create some fake users
        factory(User::class, 2)->create();

        // send the HTTP request
        $response = $this->makeCall();

        // assert response status is correct
        $response->assertStatus(403);

        $this->assertResponseContainKeyValue([
            'errors' => 'You have no access to this resource!',
            'message' => 'This action is unauthorized.',
        ]);
    }

}
