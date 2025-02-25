<?php

namespace App\Containers\AppSection\Authentication\Tests\Unit\Tasks;

use App\Containers\AppSection\Authentication\Data\Dto\WebClient\PasswordGrantLoginProxy;
use App\Containers\AppSection\Authentication\Exceptions\LoginFailed;
use App\Containers\AppSection\Authentication\Tasks\CallOAuthServerTask;
use App\Containers\AppSection\Authentication\Tests\UnitTestCase;
use App\Containers\AppSection\User\Models\User;
use PHPUnit\Framework\Attributes\CoversClass;

#[CoversClass(CallOAuthServerTask::class)]
final class CallOAuthServerTaskTest extends UnitTestCase
{
    public function testCallOAuthServer(): void
    {
        $this->setupPasswordGrantClient();
        $credentials = [
            'email' => 'gandalf@the.grey',
            'password' => 'youShallNotPass',
        ];
        User::factory()->createOne($credentials);
        $data = PasswordGrantLoginProxy::create($credentials['email'], $credentials['password']);
        $task = app(CallOAuthServerTask::class);

        $task->run($data);

        $this->expectNotToPerformAssertions();
    }

    public function testCallOAuthServerWithInvalidCredentials(): void
    {
        $this->expectException(LoginFailed::class);

        User::factory()->createOne(['email' => 'gandalf@the.grey', 'password' => 'youShallNotPass']);
        $data = PasswordGrantLoginProxy::create('nonexisting@email.void', 'invalidPassword');
        $task = app(CallOAuthServerTask::class);

        $task->run($data);
    }
}
