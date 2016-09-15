<?php

namespace App\Containers\User\UI\API\Tests\Functional;

use App\Port\Tests\PHPUnit\Abstracts\TestCase;

/**
 * Class RegisterUserThatWasVisitorTest.
 *
 * @author Mahmoud Zalt <mahmoud@zalt.me>
 */
class RegisterUserThatWasVisitorTest extends TestCase
{

    private $endpoint = '/user/register';

    public function testRegisterExistingVisitorAsNewUserWithCredentials_()
    {
        $data = [
            'email'    => 'hello@mail.dev',
            'name'     => 'Hello',
            'password' => 'secret',
        ];

        $visitor = $this->getVisitor();

        $headers['visitor-id'] = $visitor->visitor_id;

        // send the HTTP request
        $response = $this->apiCall($this->endpoint, 'post', $data, false, $headers);

        // assert response status is correct
        $this->assertEquals($response->getStatusCode(), '200');

        $this->assertResponseContainKeyValue([
            'email' => $data['email'],
            'name'  => $data['name'],
        ], $response);

         // assert response contain the token
        $this->assertResponseContainKeys(['id', 'token'], $response);

         // assert the data is stored in the database
        $this->seeInDatabase('users', ['email' => $data['email']]);
    }

}
