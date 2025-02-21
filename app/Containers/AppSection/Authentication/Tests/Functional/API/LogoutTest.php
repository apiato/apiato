<?php

namespace App\Containers\AppSection\Authentication\Tests\Functional\API;

use App\Containers\AppSection\Authentication\Tests\Functional\ApiTestCase;
use App\Containers\AppSection\Authentication\UI\API\Controllers\LogoutController;
use App\Containers\AppSection\User\Models\User;
use Laravel\Passport\Passport;
use PHPUnit\Framework\Attributes\CoversClass;

#[CoversClass(LogoutController::class)]
final class LogoutTest extends ApiTestCase
{
    public function testCanLogout(): void
    {
        $user = User::factory()->create();
        $tokenResult = $user->createToken('Test Token');
        $accessToken = $tokenResult->token;
        Passport::actingAs($user, ['*'])->withAccessToken($accessToken);
        $this->assertFalse($accessToken->revoked);

        $response = $this->postJson(action(LogoutController::class));

        $response->assertAccepted();
        $this->assertTrue($accessToken->refresh()->revoked);
        $response->assertCookieExpired('refreshToken');
    }
}
