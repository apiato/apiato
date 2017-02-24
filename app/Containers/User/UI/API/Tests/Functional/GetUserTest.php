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
        'roles'       => 'admin',
        'permissions' => '',
    ];

    public function testGetUser_()
    {
        $admin = $this->getTestingUser();

        // send the HTTP request
        $response = $this->injectId($admin->id)->makeCall();

        // assert response status is correct
        $this->assertEquals('200', $response->getStatusCode());

        $responseObject = $this->getResponseObject($response);

        $this->assertEquals($admin->name, $responseObject->data->name);
    }

}
