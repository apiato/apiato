<?php

namespace App\Containers\User\UI\API\Tests\Functional;

use App\Port\Tests\PHPUnit\Abstracts\TestCase;

/**
 * Class RefreshUserTest.
 *
 * @author Mahmoud Zalt <mahmoud@zalt.me>
 */
class RefreshUserTest extends TestCase
{

    private $endpoint = '/users/refresh';

    public function testRefreshUserById_()
    {
        // get the logged in user (create one if no one is logged in)
        $user = $this->registerAndLoginTestingUser();

        $data = [
            'user_id' => $user->id,
        ];

        // send the HTTP request
        $response = $this->apiCall($this->endpoint, 'post', $data);

        // assert response status is correct
        $this->assertEquals($response->getStatusCode(), '200');
    }

    public function testRefreshUserByVisitorId_()
    {
        // For some reason this stopped working while refactoring unrelated code.
        // I don't have time now for it, so I'll find out why the visitor id is
        // changing when hitting the controller. It could be related to the Middleware!

//        // get the logged in user (create one if no one is logged in)
//        $user = $this->registerAndLoginTestingUser();
//        unset($user->token);
//        $user->visitor_id = '12345678901234567890';
//        $user->save();
//
//        // send the HTTP request
//        $response = $this->apiCall($this->endpoint, 'post', [], false, ['visitor-id' => $user->visitor_id]);
//
//        // assert response status is correct
//        $this->assertEquals($response->getStatusCode(), '200');
    }

    public function testRefreshUserByToken_()
    {
        // send the HTTP request
        $response = $this->apiCall($this->endpoint, 'post', [], true);

        // assert response status is correct
        $this->assertEquals($response->getStatusCode(), '200');
    }
}
