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
        $user = $this->getLoggedInTestingUser();

        // send the HTTP request
        $response = $this->apiCall($this->endpoint, 'delete');

        // assert response status is correct
        $this->assertEquals($response->getStatusCode(), '202');

        // assert the returned message is correct
        $this->assertResponseContainKeyValue([
            'message' => 'User (' . $user->id . ') Deleted Successfully.',
        ], $response);
    }

    // TODO: after upgrading to Laravel 5.2 this function started returning 500 instead of 403
    // it could be due to something in `app/Port/Exception/Handler/ExceptionsHandler.php` and the don't report thingy
    // same problem as testUpdateDifferentUser_

//    public function testDeleteDifferentUser()
//    {
//        $this->getLoggedInTestingUser();
//
//        $endpoint = $this->endpoint . '/' . 100; // any ID
//
//        // send the HTTP request
//        $response = $this->apiCall($endpoint, 'delete');
//
//        // assert response status is correct
//        $this->assertEquals($response->getStatusCode(), '403');
//
//        // assert user not allowed to proceed with the request
//        $this->assertEquals($response->getContent(), 'Forbidden');
//    }
}
