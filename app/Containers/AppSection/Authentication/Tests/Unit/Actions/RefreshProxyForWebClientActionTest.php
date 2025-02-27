<?php

namespace App\Containers\AppSection\Authentication\Tests\Unit\Actions;

use App\Containers\AppSection\Authentication\Actions\RefreshProxyForWebClientAction;
use App\Containers\AppSection\Authentication\Data\Dto\Token;
use App\Containers\AppSection\Authentication\Tests\UnitTestCase;
use App\Containers\AppSection\Authentication\Values\Clients\WebClient;
use App\Containers\AppSection\Authentication\Values\OAuth2\Proxies\PasswordGrant\AccessTokenProxy;
use App\Containers\AppSection\Authentication\Values\RefreshToken;
use App\Containers\AppSection\Authentication\Values\UserCredential;
use App\Containers\AppSection\User\Models\User;
use PHPUnit\Framework\Attributes\CoversClass;

#[CoversClass(RefreshProxyForWebClientAction::class)]
final class RefreshProxyForWebClientActionTest extends UnitTestCase
{
    public function testCanGetTokenViaRefreshToken(): void
    {
        $user = User::factory()->createOne(['password' => 'youShallNotPass']);
        $refreshToken = User::issueToken(
            AccessTokenProxy::create(
                UserCredential::create(
                    $user->email,
                    'youShallNotPass',
                ),
                WebClient::fake(),
            ),
        )->refreshToken;
        $action = app(RefreshProxyForWebClientAction::class);

        $this->assertCount(1, $user->tokens);

        $result = $action->run(RefreshToken::create($refreshToken));

        $this->assertInstanceOf(Token::class, $result);
    }
}
