<?php

namespace App\Containers\AppSection\Authentication\Tests\Unit\Actions\Api\WebClient;

use App\Containers\AppSection\Authentication\Actions\Api\WebClient\IssueTokenAction;
use App\Containers\AppSection\Authentication\Data\DTOs\PasswordToken;
use App\Containers\AppSection\Authentication\Data\Factories\ClientFactory;
use App\Containers\AppSection\Authentication\Tests\UnitTestCase;
use App\Containers\AppSection\Authentication\Values\UserCredential;
use App\Containers\AppSection\User\Models\User;
use PHPUnit\Framework\Attributes\CoversClass;

#[CoversClass(IssueTokenAction::class)]
final class IssueTokenActionTest extends UnitTestCase
{
    public function testCanLogin(): void
    {
        ClientFactory::webClient();
        $credentials = [
            'email' => 'ganldalf@the.grey',
            'password' => 'youShallNotPass',
        ];
        $user = User::factory()->createOne($credentials);
        $action = app(IssueTokenAction::class);

        $this->assertCount(0, $user->tokens);

        $result = $action->run(UserCredential::create($credentials['email'], $credentials['password']));

        $this->assertInstanceOf(PasswordToken::class, $result);
    }
}
