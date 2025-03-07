<?php

namespace App\Containers\AppSection\Authentication\Tests\Unit\Actions\Api\WebClient;

use App\Containers\AppSection\Authentication\Actions\Api\WebClient\RefreshTokenAction;
use App\Containers\AppSection\Authentication\Data\DTOs\PasswordToken;
use App\Containers\AppSection\Authentication\Data\Factories\ClientFactory;
use App\Containers\AppSection\Authentication\Data\Factories\PasswordTokenFactory;
use App\Containers\AppSection\Authentication\Tests\UnitTestCase;
use App\Containers\AppSection\Authentication\Values\RefreshToken;
use App\Containers\AppSection\Authentication\Values\RequestProxies\PasswordGrant\AccessTokenProxy;
use App\Containers\AppSection\Authentication\Values\UserCredential;
use App\Containers\AppSection\User\Models\User;
use PHPUnit\Framework\Attributes\CoversClass;

#[CoversClass(RefreshTokenAction::class)]
final class RefreshTokenActionTest extends UnitTestCase
{
    public function testCanGetTokenViaRefreshToken(): void
    {
        $user = User::factory()->createOne(['password' => 'youShallNotPass']);
        $refreshToken = app(PasswordTokenFactory::class)->make(
            AccessTokenProxy::create(
                UserCredential::create(
                    $user->email,
                    'youShallNotPass',
                ),
                ClientFactory::webClient(),
            ),
        )->refreshToken->value();
        $action = app(RefreshTokenAction::class);

        $this->assertCount(1, $user->tokens);

        $result = $action->run(RefreshToken::create($refreshToken));

        $this->assertInstanceOf(PasswordToken::class, $result);
    }
}
