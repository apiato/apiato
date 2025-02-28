<?php

namespace App\Containers\AppSection\Authentication\Tests\Unit\Actions\Api;

use App\Containers\AppSection\Authentication\Actions\Api\RevokeTokenAction;
use App\Containers\AppSection\Authentication\Tests\UnitTestCase;
use App\Containers\AppSection\Authentication\Values\ClientCredentials\WebClientCredential;
use App\Containers\AppSection\Authentication\Values\OAuth2\Proxies\PasswordGrant\AccessTokenProxy;
use App\Containers\AppSection\Authentication\Values\UserCredential;
use App\Containers\AppSection\User\Models\User;
use PHPUnit\Framework\Attributes\CoversClass;

#[CoversClass(RevokeTokenAction::class)]
final class RevokeTokenActionTest extends UnitTestCase
{
    public function testCanGetTokenViaRefreshToken(): void
    {
        $user = User::factory()->createOne([
            'password' => 'youShallNotPass',
        ]);
        $this->assertCount(0, $user->tokens);
        User::issueToken(
            AccessTokenProxy::create(
                UserCredential::create(
                    $user->email,
                    'youShallNotPass',
                ),
                WebClientCredential::fake(),
            ),
        )->for($user);
        $this->assertCount(1, $user->tokens);
        $this->assertFalse($user->token()->revoked);
        $action = app(RevokeTokenAction::class);

        $result = $action->run($user);

        $this->assertTrue($user->token()->revoked);
        $this->assertTrue($result->isCleared());
    }
}
