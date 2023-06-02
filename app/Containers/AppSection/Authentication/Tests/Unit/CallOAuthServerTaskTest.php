<?php

namespace App\Containers\AppSection\Authentication\Tests\Unit;

use App\Containers\AppSection\Authentication\Exceptions\LoginFailedException;
use App\Containers\AppSection\Authentication\Tasks\CallOAuthServerTask;
use App\Containers\AppSection\Authentication\Tests\UnitTestCase;

/**
 * @group authentication
 * @group unit
 */
class CallOAuthServerTaskTest extends UnitTestCase
{
    public function testCallOAuthServer()
    {
        $data = [
            'grant_type' => 'password',
            'client_id' => $this->clientId,
            'client_secret' => $this->clientSecret,
            'username' => 'gandalf@the.grey',
            'password' => 'youShallNotPass',
            'scope' => '',
        ];
        $this->getTestingUser([
            'email' => $data['username'],
            'password' => $data['password'],
        ]);
        $task = app(CallOAuthServerTask::class);

        $result = $task->run($data);

        $this->assertArrayHasKey('access_token', $result);
        $this->assertArrayHasKey('token_type', $result);
        $this->assertArrayHasKey('expires_in', $result);
        $this->assertArrayHasKey('refresh_token', $result);
    }

    public function testCallOAuthServerWithInvalidCredentials()
    {
        $this->expectException(LoginFailedException::class);
        $this->expectExceptionMessage('The user credentials were incorrect.');
        $this->expectExceptionCode(422);
        $data = [
            'grant_type' => 'password',
            'client_id' => $this->clientId,
            'client_secret' => $this->clientSecret,
            'username' => 'nonexisting@email.void',
            'password' => 'invalidPassword',
            'scope' => '',
        ];
        $this->getTestingUser([
            'email' => 'gandalf@the.grey',
            'password' => 'youShallNotPass',
        ]);
        $task = app(CallOAuthServerTask::class);

        $task->run($data);
    }
}
