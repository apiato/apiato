<?php

namespace App\Containers\User\UI\API\Tests\Functional;

use App\Port\Test\PHPUnit\Abstracts\TestCase;

/**
 * Class DeleteUserTest.
 *
 * @author Mahmoud Zalt <mahmoud@zalt.me>
 */
class DeleteUserTest extends TestCase
{

    protected $endpoint = '/users';

    protected $access = [
        'roles'       => '',
        'permissions' => 'delete-users',
    ];

    public function testDeleteExistingUser_()
    {
        $user = $this->getTestingUser();

        // send the HTTP request
        $response = $this->apiCall($this->endpoint, 'delete');

        // assert response status is correct
        $this->assertEquals('202', $response->getStatusCode());

        // assert the returned message is correct
        $this->assertResponseContainKeyValue([
            'message' => 'User (' . $user->id . ') Deleted Successfully.',
        ], $response);
    }

}
