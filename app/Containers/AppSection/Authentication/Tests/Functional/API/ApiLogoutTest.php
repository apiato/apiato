<?php

namespace App\Containers\AppSection\Authentication\Tests\Functional\API;

use App\Containers\AppSection\Authentication\Actions\ApiLogoutAction;
use App\Containers\AppSection\Authentication\Tests\FunctionalTestCase;
use App\Containers\AppSection\User\Models\User;
use Laravel\Passport\Passport;
use PHPUnit\Framework\Attributes\CoversClass;

#[CoversClass(ApiLogoutAction::class)]
final class ApiLogoutTest extends FunctionalTestCase
{
    protected string $endpoint = 'post@v1/logout';

    public function testCanLogout(): void
    {
        $user = User::factory()->create();
        $tokenResult = $user->createToken('Test Token');
        $accessToken = $tokenResult->token;
        Passport::actingAs($user, ['*'])->withAccessToken($accessToken);
        $this->assertFalse($accessToken->revoked);

        $response = $this->makeCall();

        $response->assertAccepted();
        $this->assertTrue($accessToken->refresh()->revoked);
        $response->assertCookieExpired('refreshToken');
    }
}
