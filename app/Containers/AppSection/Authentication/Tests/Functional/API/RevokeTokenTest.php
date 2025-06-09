<?php

declare(strict_types=1);

namespace App\Containers\AppSection\Authentication\Tests\Functional\API;

use App\Containers\AppSection\Authentication\Data\Factories\ClientFactory;
use App\Containers\AppSection\Authentication\Data\Factories\PasswordTokenFactory;
use App\Containers\AppSection\Authentication\Tests\Functional\ApiTestCase;
use App\Containers\AppSection\Authentication\UI\API\Controllers\RevokeTokenController;
use App\Containers\AppSection\Authentication\Values\RequestProxies\PasswordGrant\AccessTokenProxy;
use App\Containers\AppSection\Authentication\Values\UserCredential;
use App\Containers\AppSection\User\Data\Factories\UserFactory;
use App\Containers\AppSection\User\Models\User;
use PHPUnit\Framework\Attributes\CoversClass;

#[CoversClass(RevokeTokenController::class)]
final class RevokeTokenTest extends ApiTestCase
{
    public function testCanLogout(): void
    {
        /** @var User|UserFactory<User> $user */
        $user = User::factory()->createOne([
            'password' => 'password',
        ]);

        /** @var PasswordTokenFactory $passwordTokenFactory */
        $passwordTokenFactory = app(PasswordTokenFactory::class);

        self::assertCount(0, $user->tokens);

        $passwordTokenFactory->for($user)->make(
            AccessTokenProxy::create(
                UserCredential::create(
                    $user->email,
                    'password',
                ),
                ClientFactory::webClient(),
            ),
        );
        self::assertCount(1, $user->tokens);
        self::assertFalse($user->token()->revoked);
        $this->actingAs($user, 'api');

        $response = $this->postJson(action(RevokeTokenController::class));

        $response->assertAccepted();
        self::assertNull($user->fresh()->token());
        $response->assertCookieExpired('refreshToken');
    }
}
