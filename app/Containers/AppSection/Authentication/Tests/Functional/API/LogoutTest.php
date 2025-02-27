<?php

namespace App\Containers\AppSection\Authentication\Tests\Functional\API;

use App\Containers\AppSection\Authentication\Tests\Functional\ApiTestCase;
use App\Containers\AppSection\Authentication\UI\API\Controllers\LogoutController;
use App\Containers\AppSection\Authentication\Values\Clients\WebClient;
use App\Containers\AppSection\Authentication\Values\OAuth2\Proxies\PasswordGrant\AccessTokenProxy;
use App\Containers\AppSection\Authentication\Values\UserCredential;
use App\Containers\AppSection\User\Models\User;
use Laravel\Passport\Passport;
use PHPUnit\Framework\Attributes\CoversClass;

#[CoversClass(LogoutController::class)]
final class LogoutTest extends ApiTestCase
{
    public function testCanLogout(): void
    {
        $user = User::factory()->createOne([
            'password' => 'password',
        ]);

        $this->assertCount(0, $user->tokens);
        User::issueToken(AccessTokenProxy::create(UserCredential::create($user->email, 'password'), WebClient::fake()));
        $user = $user->fresh();
        $userToken = $user->tokens->first();
        $this->assertCount(1, $user->tokens);
        $this->assertFalse($userToken->revoked);

        Passport::actingAs($user)->withAccessToken($userToken);

        $response = $this->postJson(action(LogoutController::class));

        $response->assertAccepted();
        $this->assertTrue($userToken->revoked);
        $response->assertCookieExpired('refreshToken');
    }
}
