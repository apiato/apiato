<?php

namespace App\Containers\AppSection\Authentication\Tests\Unit\Tasks;

use App\Containers\AppSection\Authentication\Exceptions\LoginFailedException;
use App\Containers\AppSection\Authentication\Tasks\CallOAuthServerTask;
use App\Containers\AppSection\Authentication\Tests\UnitTestCase;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\Group;

#[Group('authentication')]
#[CoversClass(CallOAuthServerTask::class)]
class CallOAuthServerTaskTest extends UnitTestCase
{
    public function testCallOAuthServer(): void
    {
        $credentials = [
            'email' => 'gandalf@the.grey',
            'password' => 'youShallNotPass',
        ];
        $this->getTestingUser($credentials);
        $data = $this->enrichWithPasswordGrantFields($credentials['email'], $credentials['password']);
        $task = app(CallOAuthServerTask::class);

        $result = $task->run($data);

        $this->assertArrayHasKey('access_token', $result);
        $this->assertArrayHasKey('token_type', $result);
        $this->assertArrayHasKey('expires_in', $result);
        $this->assertArrayHasKey('refresh_token', $result);
    }

    public function testCallOAuthServerWithInvalidCredentials(): void
    {
        $this->expectException(LoginFailedException::class);
        $this->expectExceptionMessage('The user credentials were incorrect.');
        $this->expectExceptionCode(422);

        $this->getTestingUser(['email' => 'gandalf@the.grey', 'password' => 'youShallNotPass']);
        $data = $this->enrichWithPasswordGrantFields('nonexisting@email.void', 'invalidPassword');
        $task = app(CallOAuthServerTask::class);

        $task->run($data);
    }
}
