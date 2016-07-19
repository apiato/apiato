<?php

namespace App\Containers\User\UI\API\Tests\Functional;

use App\Port\Tests\PHPUnit\Abstracts\TestCase;

/**
 * Class AutoRegisterTest.
 *
 * @author Mahmoud Zalt <mahmoud@zalt.me>
 */
class AutoRegisterTest extends TestCase
{

    // works with any random endpoint, since when activated this applies by a middleware
    private $endpoint = '/say-welcome';

    public function testRegisterNewUserWithoutCredentials_()
    {
        // send the HTTP request
        // the header `Agent-Id` is automatically added for non protected routes
        $response = $this->apiCall($this->endpoint, 'get', [], false);

        // assert response status is correct
        $this->assertEquals($response->getStatusCode(), '200');

    }

    public function testSendingAgentAndToken()
    {
        $headers = ['Agent-Id' => str_random(40)];

        // send the HTTP request
        // since this is marked as protected endpoint a Token will by added to the headers
        // and also and Agent-Id is added to the same deader
        $response = $this->apiCall($this->endpoint, 'get', [], true, $headers);

        // assert response status is correct
        $this->assertEquals($response->getStatusCode(), '200');
    }

}
