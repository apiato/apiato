<?php

namespace App\Containers\User\UI\API\Tests\Functional;

use App\Containers\User\Tests\TestCase;

/**
 * Class DeleteUserTest.
 *
 * @author Mahmoud Zalt <mahmoud@zalt.me>
 */
class DeleteUserTest extends TestCase
{

    protected $endpoint = '/users/{id}';

    protected $access = [
        'roles'       => '',
        'permissions' => 'delete-users',
    ];

    public function testDeleteExistingUser_()
    {
        $user = $this->getTestingUser();

        // send the HTTP request
        $response = $this->apiCall($this->injectEndpointId($this->endpoint, $user->id), 'delete');

        // assert response status is correct
        $this->assertEquals('202', $response->getStatusCode());

        // assert the returned message is correct
        $this->assertResponseContainKeyValue([
            'message' => 'User (' . $user->id . ') Deleted Successfully.',
        ], $response);
    }

}
