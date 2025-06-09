<?php

declare(strict_types=1);

namespace App\Containers\AppSection\Authentication\Tests\Unit\Tasks;

use App\Containers\AppSection\Authentication\Data\Factories\ClientFactory;
use App\Containers\AppSection\Authentication\Data\Factories\PasswordTokenFactory;
use App\Containers\AppSection\Authentication\Tests\UnitTestCase;
use App\Containers\AppSection\Authentication\Values\RefreshToken;
use App\Containers\AppSection\Authentication\Values\RequestProxies\PasswordGrant\AccessTokenProxy;
use App\Containers\AppSection\Authentication\Values\RequestProxies\PasswordGrant\RefreshTokenProxy;
use App\Containers\AppSection\Authentication\Values\UserCredential;
use App\Containers\AppSection\User\Data\Factories\UserFactory;
use App\Containers\AppSection\User\Models\User;
use PHPUnit\Framework\Attributes\CoversClass;

#[CoversClass(PasswordTokenFactory::class)]
final class PasswordTokenFactoryTest extends UnitTestCase
{
    public function testCanIssueAccessToken(): void
    {
        /** @var User|UserFactory<User> $user */
        $user = User::factory()->createOne(['password' => 'youShallNotPass']);
        /** @var PasswordTokenFactory $factory */
        $factory = app(PasswordTokenFactory::class);

        self::assertCount(0, $user->tokens);

        $factory->make(
            AccessTokenProxy::create(
                UserCredential::create(
                    $user->email,
                    'youShallNotPass',
                ),
                ClientFactory::webClient(),
            ),
        );

        self::assertCount(1, $user->refresh()->tokens);
    }

    public function testCanIssueRefreshToken(): void
    {
        /** @var User|UserFactory<User> $user */
        $user = User::factory()->createOne(['password' => 'youShallNotPass']);
        /** @var PasswordTokenFactory $factory */
        $factory = app(PasswordTokenFactory::class);
        $client = ClientFactory::webClient();
        $refreshToken = $factory->make(
            AccessTokenProxy::create(
                UserCredential::create(
                    $user->email,
                    'youShallNotPass',
                ),
                $client,
            ),
        )->refreshToken->value();

        self::assertCount(1, $user->refresh()->tokens);

        $factory->make(
            RefreshTokenProxy::create(
                RefreshToken::create(
                    $refreshToken,
                ),
                $client,
            ),
        );

        $tokens = $user->refresh()->tokens;
        self::assertCount(2, $tokens);
        self::assertCount(1, $tokens->where('revoked', true));
        self::assertCount(1, $tokens->where('revoked', false));
    }
}
