<?php

namespace Mega\Modules\User\Tests\Api;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Mega\Services\Core\Test\Abstracts\TestCase;

/**
 * Class LogoutEndpointTest.
 *
 * @author Mahmoud Zalt <mahmoud@zalt.me>
 */
class LogoutTest extends TestCase
{
    use DatabaseMigrations;

    private $endpoint = '/logout';

    public function testLogout_()
    {
        // send the HTTP request
        $response = $this->apiCall($this->endpoint, 'post');

        // assert response status is correct
        $this->assertEquals($response->getStatusCode(), '202');

        // assert returned message is right
        $this->assertResponseContainKeyValue([
            'message' => 'User Logged Out Successfully.',
        ], $response);
    }

    public function testLogoutWithGetRequest()
    {
        // send the HTTP request
        $response = $this->apiCall($this->endpoint, 'get');

        $this->assertEquals($response->getStatusCode(), '405');

        $this->assertResponseContainKeyValue([
            'message' => '405 Method Not Allowed',
        ], $response);
    }

    public function testLogoutWithoutToken()
    {
        // send the HTTP request
        $response = $this->apiCall($this->endpoint, 'post', [], false);

        // assert response status is correct
        $this->assertEquals($response->getStatusCode(), '401');

        $this->assertResponseContainKeyValue([
            'message' => 'Failed to authenticate because of bad credentials or an invalid authorization header.',
        ], $response);
    }
}
