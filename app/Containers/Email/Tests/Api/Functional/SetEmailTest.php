<?php

namespace App\Containers\Email\Tests\Api\Functional;

use App\Port\Tests\PHPUnit\Abstracts\TestCase;

/**
 * Class SetEmailTest.
 *
 * @author Mahmoud Zalt <mahmoud@zalt.me>
 */
class SetEmailTest extends TestCase
{

    private $endpoint = '/users/{id}/email';

    public function testSetUserEmail_()
    {
        $userDetails = [
            'email'    => 'hello@mail.dev',
            'name'     => 'Hello',
            'password' => 'secret',
        ];

        // get the logged in user (create one if no one is logged in)
        $user = $this->registerAndLoginTestingUser($userDetails);

        $data = [
            'email' => 'test@test.test',
        ];

        $this->endpoint = str_replace("{id}", $user->id, $this->endpoint);

        // send the HTTP request
        $response = $this->apiCall($this->endpoint, 'post', $data, true);

        // assert response status is correct
        $this->assertEquals($response->getStatusCode(), '202');

    }

}
