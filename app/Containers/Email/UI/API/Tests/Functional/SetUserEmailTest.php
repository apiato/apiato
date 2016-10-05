<?php

namespace App\Containers\Email\UI\API\Tests\Functional;

use App\Containers\Email\Mails\ConfirmEmail;
use App\Port\Tests\PHPUnit\Abstracts\TestCase;

/**
 * Class SetUserEmailTest.
 *
 * @author Mahmoud Zalt <mahmoud@zalt.me>
 */
class SetUserEmailTest extends TestCase
{

    private $endpoint = '/users/email';

    public function testSetUserEmail_()
    {
        $userDetails = [
            'email'    => 'hello@mail.dev',
            'name'     => 'Hello',
            'password' => 'secret',
        ];

        // get the logged in user (create one if no one is logged in)
        $this->registerAndLoginTestingUser($userDetails);

        $data = [
            'email' => 'test@test.test',
        ];

        // mock sending real emails
        $confirmEmail = $this->mock(ConfirmEmail::class);
        $confirmEmail->shouldReceive('send')->once()->withAnyArgs()->andReturn(true);
        $confirmEmail->shouldReceive('to')->once()->withAnyArgs()->andReturn($confirmEmail);

        // send the HTTP request
        $response = $this->apiCall($this->endpoint, 'post', $data, true);

        // assert response status is correct
        $this->assertEquals($response->getStatusCode(), '202');

        $this->assertResponseContainKeyValue(['message' => 'User Email Saved Successfully.'], $response);

        $this->seeInDatabase('users', ['email' => $data['email']]);

    }

}
