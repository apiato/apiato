<?php

namespace App\Containers\AppSection\Authentication\Tests\Functional\API;

use App\Containers\AppSection\Authentication\Data\Factories\ClientFactory;
use App\Containers\AppSection\Authentication\Data\Factories\PasswordTokenFactory;
use App\Containers\AppSection\Authentication\Tests\Functional\ApiTestCase;
use App\Containers\AppSection\Authentication\UI\API\Controllers\RevokeTokenController;
use App\Containers\AppSection\Authentication\Values\RequestProxies\PasswordGrant\AccessTokenProxy;
use App\Containers\AppSection\Authentication\Values\UserCredential;
use App\Containers\AppSection\User\Models\User;
use PHPUnit\Framework\Attributes\CoversClass;

#[CoversClass(RevokeTokenController::class)]
final class RevokeTokenTest extends ApiTestCase
{
    public function testCanLogout(): void
    {
        $user = User::factory()->createOne([
            'password' => 'password',
        ]);

        $this->assertCount(0, $user->tokens);

        app(PasswordTokenFactory::class)->for($user)->make(
            AccessTokenProxy::create(
                UserCredential::create(
                    $user->email,
                    'password',
                ),
                ClientFactory::webClient(),
            ),
        );
        $this->assertCount(1, $user->tokens);
        $this->assertFalse($user->token()->revoked);
        $this->actingAs($user, 'api');

        $response = $this->postJson(action(RevokeTokenController::class));

        $response->assertAccepted();
        $this->assertNull($user->fresh()->token());
        $response->assertCookieExpired('refreshToken');
    }
}
