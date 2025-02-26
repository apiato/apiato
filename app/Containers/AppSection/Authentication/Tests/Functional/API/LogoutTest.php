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
        $this->markTestSkipped('This test has not been implemented yet.');
        WebClient::fake();
        $user = User::factory()->createOne([
            'password' => 'password',
        ]);
        User::issueToken(AccessTokenProxy::create(UserCredential::create($user->email, 'password'), WebClient::create()));
        //        $tokenResult = $user->createToken('Test Token');
        //        $accessToken = $tokenResult->token;
        //        Passport::actingAs($user, ['*'])->withAccessToken($accessToken);
        Passport::actingAs($user);
        dd($user->fresh()->token());
        $this->assertFalse($user->fresh()->token()->revoked);

        $response = $this->postJson(action(LogoutController::class));

        $response->assertAccepted();
        $this->assertTrue($user->refresh()->token()->revoked);
        $response->assertCookieExpired('refreshToken');
    }
}
