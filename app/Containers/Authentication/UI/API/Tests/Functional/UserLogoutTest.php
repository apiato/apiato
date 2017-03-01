<?php

namespace App\Containers\Authentication\UI\API\Tests\Functional;

use App\Containers\Authentication\Tests\TestCase;

/**
 * Class UserLogoutTest.
 *
 * @author Mahmoud Zalt <mahmoud@zalt.me>
 */
class UserLogoutTest extends TestCase
{

    protected $endpoint = 'post@logout';

    public function testUserLogout_()
    {
        // send the HTTP request
        $response = $this->makeCall();

        // assert response status is correct
        $this->assertEquals('202', $response->getStatusCode());

        // assert message is correct
        $this->assertResponseContainKeyValue([
            'message' => 'User Logged Out Successfully.',
        ], $response);
    }

    public function testUserLogoutWithGetRequest()
    {
        // send the HTTP request
        $response = $this->endpoint('get@logout')->makeCall();

        // assert response status is correct
        $this->assertEquals('405', $response->getStatusCode());

        // assert message is correct
        $this->assertResponseContainKeyValue([
            'message' => '405 Method Not Allowed',
        ], $response);
    }

    public function testUserLogoutWithoutToken()
    {
        // send the HTTP request
        $response = $this->auth(false)->makeCall();

        // assert response status is correct
        $this->assertEquals('401', $response->getStatusCode());

        // assert message is correct
        $this->assertResponseContainKeyValue([
            'message' => 'Failed to authenticate because of bad credentials or an invalid authorization header.',
        ], $response);
    }
}
