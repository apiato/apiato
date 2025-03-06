<?php

namespace App\Containers\AppSection\Authentication\Tests\Unit\Tasks;

use App\Containers\AppSection\Authentication\Tasks\IssueTokenTask;
use App\Containers\AppSection\Authentication\Tests\UnitTestCase;
use App\Containers\AppSection\Authentication\Values\ClientCredentials\WebClientCredential;
use App\Containers\AppSection\Authentication\Values\OAuth2\Proxies\PasswordGrant\AccessTokenProxy;
use App\Containers\AppSection\Authentication\Values\OAuth2\Proxies\PasswordGrant\RefreshTokenProxy;
use App\Containers\AppSection\Authentication\Values\RefreshToken;
use App\Containers\AppSection\Authentication\Values\UserCredential;
use App\Containers\AppSection\User\Models\User;
use PHPUnit\Framework\Attributes\CoversClass;

#[CoversClass(IssueTokenTask::class)]
final class IssueTokenTaskTest extends UnitTestCase
{
    public function testCanIssueAccessToken(): void
    {
        $user = User::factory()->createOne(['password' => 'youShallNotPass']);
        $task = app(IssueTokenTask::class);

        $this->assertCount(0, $user->tokens);

        $task->run(
            AccessTokenProxy::create(
                UserCredential::create(
                    $user->email,
                    'youShallNotPass',
                ),
                WebClientCredential::fake(),
            ),
        );

        $this->assertCount(1, $user->refresh()->tokens);
    }

    public function testCanIssueRefreshToken(): void
    {
        $user = User::factory()->createOne(['password' => 'youShallNotPass']);
        $task = app(IssueTokenTask::class);
        $refreshToken = $task->run(
            AccessTokenProxy::create(
                UserCredential::create(
                    $user->email,
                    'youShallNotPass',
                ),
                WebClientCredential::fake(),
            ),
        )->refreshToken;

        $this->assertCount(1, $user->refresh()->tokens);

        $task->run(RefreshTokenProxy::create(RefreshToken::create($refreshToken), WebClientCredential::create()));

        $tokens = $user->refresh()->tokens;
        $this->assertCount(2, $tokens);
        $this->assertSame(1, $tokens->where('revoked', true)->count());
        $this->assertSame(1, $tokens->where('revoked', false)->count());
    }
}
