<?php

namespace App\Containers\User\UI\API\Tests\Functional;

use App\Containers\User\Tests\TestCase;

/**
 * Class FindUsersTest.
 *
 * @author  Mahmoud Zalt <mahmoud@zalt.me>
 */
class FindUserTest extends TestCase
{

    protected $endpoint = 'get@v1/users/{id}';

    protected $access = [
        'roles'       => '',
        'permissions' => 'search-users',
    ];

    public function testFindUser_()
    {
        $admin = $this->getTestingUser();

        // send the HTTP request
        $response = $this->injectId($admin->id)->makeCall();

        // assert response status is correct
        $response->assertStatus(200);

        $responseContent = $this->getResponseContentObject();

        $this->assertEquals($admin->name, $responseContent->data->name);
    }

    public function testFindFilteredUserResponse_()
    {
        $admin = $this->getTestingUser();

        // send the HTTP request
        $response = $this->injectId($admin->id)->endpoint($this->endpoint . '?filter=email;name')->makeCall();

        // assert response status is correct
        $response->assertStatus(200);

        $responseContent = $this->getResponseContentObject();

        $this->assertEquals($admin->name, $responseContent->data->name);
        $this->assertEquals($admin->email, $responseContent->data->email);

        $this->assertNotContains('id', json_decode($response->getContent(), true));
    }

    public function testFindUserWithRelation_()
    {
        $admin = $this->getTestingUser();

        // send the HTTP request
        $response = $this->injectId($admin->id)->endpoint($this->endpoint . '?include=roles')->makeCall();

        // assert response status is correct
        $response->assertStatus(200);

        $responseContent = $this->getResponseContentObject();

        $this->assertEquals($admin->email, $responseContent->data->email);

        $this->assertNotNull($responseContent->data->roles);
    }

}
