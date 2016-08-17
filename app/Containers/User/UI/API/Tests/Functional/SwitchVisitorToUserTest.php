<?php

namespace App\Containers\User\UI\API\Tests\Functional;

use App\Containers\User\Models\User;
use App\Port\Tests\PHPUnit\Abstracts\TestCase;

/**
 * Class SwitchVisitorToUserTest.
 *
 * @author Mahmoud Zalt <mahmoud@zalt.me>
 */
class SwitchVisitorToUserTest extends TestCase
{

    private $endpoint = '/register/visitor';

    public function testRegisterExistingVisitorUser_()
    {
        $data = [
            'email'    => 'new@user.com',
            'password' => 'first#Password',
            'name'     => 'First time name',
        ];

        $visitorId = str_random(40);

        $visitorUser = User::create([
            'visitor_id' => $visitorId,
            'device'   => 'Android',
            'platform' => 'Google Super OS',
        ]);

        $headers['Visitor-Id'] = $visitorId;

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
        $this->seeInDatabase('users', ['visitor_id' => $visitorId]);
        $this->seeInDatabase('users', ['device' => $visitorUser->device]);
        $this->seeInDatabase('users', ['platform' => $visitorUser->platform]);
    }


}
