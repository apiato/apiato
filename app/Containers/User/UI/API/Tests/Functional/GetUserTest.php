<?php

namespace App\Containers\User\UI\API\Tests\Functional;

use App\Containers\User\Tests\TestCase;

/**
 * Class GetUsersTest.
 *
 * @author  Mahmoud Zalt <mahmoud@zalt.me>
 */
class GetUserTest extends TestCase
{

    protected $endpoint = 'get@users/{id}';

    protected $access = [
        'roles'       => '',
        'permissions' => 'search-users',
    ];

    public function testGetUser_()
    {
        $admin = $this->getTestingUser();

        // send the HTTP request
        $response = $this->injectId($admin->id)->makeCall();

        // assert response status is correct
        $response->assertStatus(200);

        $responseContent = $this->getResponseContentObject();

        $this->assertEquals($admin->name, $responseContent->data->name);
    }

}
