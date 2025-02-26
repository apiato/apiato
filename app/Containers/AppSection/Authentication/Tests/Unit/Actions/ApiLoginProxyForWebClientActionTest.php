<?php

namespace App\Containers\AppSection\Authentication\Tests\Unit\Actions;

use App\Containers\AppSection\Authentication\Actions\ApiLoginProxyForWebClientAction;
use App\Containers\AppSection\Authentication\Tests\UnitTestCase;
use App\Containers\AppSection\Authentication\Values\Clients\WebClient;
use App\Containers\AppSection\Authentication\Values\UserCredential;
use App\Containers\AppSection\User\Models\User;
use PHPUnit\Framework\Attributes\CoversClass;

#[CoversClass(ApiLoginProxyForWebClientAction::class)]
final class ApiLoginProxyForWebClientActionTest extends UnitTestCase
{
    public function testCanLogin(): void
    {
        WebClient::fake();
        $credentials = [
            'email' => 'ganldalf@the.grey',
            'password' => 'youShallNotPass',
        ];
        User::factory()->createOne($credentials);
        $action = app(ApiLoginProxyForWebClientAction::class);

        $response = $action->run(UserCredential::create($credentials['email'], $credentials['password']));

        $this->assertSame('refreshToken', $response->refreshTokenCookie->getName());
        $this->assertNotEmpty($response->token->accessToken);
    }
}
