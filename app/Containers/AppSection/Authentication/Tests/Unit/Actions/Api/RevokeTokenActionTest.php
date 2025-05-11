<?php

namespace App\Containers\AppSection\Authentication\Tests\Unit\Actions\Api;

use App\Containers\AppSection\Authentication\Actions\Api\RevokeTokenAction;
use App\Containers\AppSection\Authentication\Data\Factories\ClientFactory;
use App\Containers\AppSection\Authentication\Data\Factories\PasswordTokenFactory;
use App\Containers\AppSection\Authentication\Tests\UnitTestCase;
use App\Containers\AppSection\Authentication\Values\RequestProxies\PasswordGrant\AccessTokenProxy;
use App\Containers\AppSection\Authentication\Values\UserCredential;
use App\Containers\AppSection\User\Models\User;
use PHPUnit\Framework\Attributes\CoversClass;

#[CoversClass(RevokeTokenAction::class)]
final class RevokeTokenActionTest extends UnitTestCase
{
    public function testCanRevokeToken(): void
    {
        $user = User::factory()->createOne([
            'password' => 'youShallNotPass',
        ]);
        $this->assertCount(0, $user->tokens);
        app(PasswordTokenFactory::class)->for($user)->make(
            AccessTokenProxy::create(
                UserCredential::create(
                    $user->email,
                    'youShallNotPass',
                ),
                ClientFactory::webClient(),
            ),
        );
        $this->assertCount(1, $user->tokens);
        $this->assertFalse($user->token()->revoked);
        $action = app(RevokeTokenAction::class);

        $result = $action->run($user);

        $this->assertNull($user->fresh()->token());
        $this->assertTrue($result->isCleared());
    }
}
