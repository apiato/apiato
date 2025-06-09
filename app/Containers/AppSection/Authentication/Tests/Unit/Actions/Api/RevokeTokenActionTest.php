<?php

declare(strict_types=1);

namespace App\Containers\AppSection\Authentication\Tests\Unit\Actions\Api;

use App\Containers\AppSection\Authentication\Actions\Api\RevokeTokenAction;
use App\Containers\AppSection\Authentication\Data\Factories\ClientFactory;
use App\Containers\AppSection\Authentication\Data\Factories\PasswordTokenFactory;
use App\Containers\AppSection\Authentication\Tests\UnitTestCase;
use App\Containers\AppSection\Authentication\Values\RequestProxies\PasswordGrant\AccessTokenProxy;
use App\Containers\AppSection\Authentication\Values\UserCredential;
use App\Containers\AppSection\User\Data\Factories\UserFactory;
use App\Containers\AppSection\User\Models\User;
use Laravel\Passport\Contracts\ScopeAuthorizable;
use PHPUnit\Framework\Attributes\CoversClass;

#[CoversClass(RevokeTokenAction::class)]
final class RevokeTokenActionTest extends UnitTestCase
{
    public function testCanRevokeToken(): void
    {
        /** @var User|UserFactory<User> $user */
        $user = User::factory()->createOne([
            'password' => 'youShallNotPass',
        ]);
        self::assertCount(0, $user->tokens);
        /** @var PasswordTokenFactory $passwordTokenFactory */
        $passwordTokenFactory = app(PasswordTokenFactory::class);
        $passwordTokenFactory->for($user)->make(
            AccessTokenProxy::create(
                UserCredential::create(
                    $user->email,
                    'youShallNotPass',
                ),
                ClientFactory::webClient(),
            ),
        );
        self::assertCount(1, $user->tokens);
        self::assertFalse($user->token()->revoked);
        $action = app(RevokeTokenAction::class);

        $result = $action->run($user);

        self::assertNotInstanceOf(ScopeAuthorizable::class, $user->fresh()->token());
        self::assertTrue($result->isCleared());
    }
}
