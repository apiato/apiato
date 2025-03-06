<?php

namespace App\Containers\AppSection\Authentication\Tests\Functional\API;

use App\Containers\AppSection\Authentication\Tasks\IssueTokenTask;
use App\Containers\AppSection\Authentication\Tests\Functional\ApiTestCase;
use App\Containers\AppSection\Authentication\UI\API\Controllers\RevokeTokenController;
use App\Containers\AppSection\Authentication\Values\ClientCredentials\WebClientCredential;
use App\Containers\AppSection\Authentication\Values\OAuth2\Proxies\PasswordGrant\AccessTokenProxy;
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
        app(IssueTokenTask::class)->run(
            AccessTokenProxy::create(
                UserCredential::create(
                    $user->email,
                    'password',
                ),
                WebClientCredential::fake(),
            ),
        )->for($user);
        $this->assertCount(1, $user->tokens);
        $this->assertFalse($user->token()->revoked);
        $this->actingAs($user, 'api');

        $response = $this->postJson(action(RevokeTokenController::class));

        $response->assertAccepted();
        $this->assertTrue($user->token()->revoked);
        $response->assertCookieExpired('refreshToken');
    }
}
