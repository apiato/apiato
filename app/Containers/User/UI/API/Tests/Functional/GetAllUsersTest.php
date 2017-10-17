<?php

namespace App\Containers\User\UI\API\Tests\Functional;

use App\Containers\User\Models\User;
use App\Containers\User\Tests\TestCase;

/**
 * Class GetAllUsersTest.
 *
 * @author  Mahmoud Zalt <mahmoud@zalt.me>
 */
class GetAllUsersTest extends TestCase
{

    protected $endpoint = 'get@v1/users';

    protected $access = [
        'roles'       => 'admin',
        'permissions' => 'list-users',
    ];

    public function testGetAllUsersByAdmin_()
    {
        // create some non-admin users who are clients
        factory(User::class, 2)->create();

        // send the HTTP request
        $response = $this->makeCall();

        // assert response status is correct
        $response->assertStatus(200);

        // convert JSON response string to Object
        $responseContent = $this->getResponseContentObject();

        // assert the returned data size is correct
        $this->assertCount(4, $responseContent->data);
    }

    public function testGetAllUsersByNonAdmin_()
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

    public function testSearchUsersByName()
    {
        $user = $this->getTestingUser([
            'name' => 'mahmoudzzz'
        ]);

        // 3 random users
        factory(User::class, 3)->create();

        // send the HTTP request
        $response = $this->endpoint($this->endpoint. '?search=name:mahmoudzzz')->makeCall();

        // assert response status is correct
        $response->assertStatus(200);

        $responseArray = $response->decodeResponseJson();

        $this->assertEquals($user->name, $responseArray['data'][0]['name']);

        // assert only single user was returned
        $this->assertCount(1, $responseArray['data']);
    }

}
