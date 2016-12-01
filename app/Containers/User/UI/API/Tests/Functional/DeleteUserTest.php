<?php

namespace App\Containers\User\UI\API\Tests\Functional;

use App\Port\Tests\PHPUnit\Abstracts\TestCase;

/**
 * Class DeleteUserTest.
 *
 * @author Mahmoud Zalt <mahmoud@zalt.me>
 */
class DeleteUserTest extends TestCase
{

    private $endpoint = '/users';

    public function testDeleteExistingUser_()
    {
        $user = $this->getLoggedInTestingAdmin();

        // send the HTTP request
        $response = $this->apiCall($this->endpoint, 'delete');

        // assert response status is correct
        $this->assertEquals($response->getStatusCode(), '202');

        // assert the returned message is correct
        $this->assertResponseContainKeyValue([
            'message' => 'User (' . $user->id . ') Deleted Successfully.',
        ], $response);
    }

}
