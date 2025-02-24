<?php

namespace App\Containers\AppSection\Authentication\Tests\Unit\Actions;

use App\Containers\AppSection\Authentication\Actions\ApiLoginProxyForWebClientAction;
use App\Containers\AppSection\Authentication\Data\Dto\WebClient\PasswordGrantLoginProxy;
use App\Containers\AppSection\Authentication\Tests\UnitTestCase;
use App\Containers\AppSection\User\Models\User;
use PHPUnit\Framework\Attributes\CoversClass;

#[CoversClass(ApiLoginProxyForWebClientAction::class)]
final class ApiLoginProxyForWebClientActionTest extends UnitTestCase
{
    public function testCanLogin(): void
    {
        $this->setupPasswordGrantClient();
        $credentials = [
            'email' => 'ganldalf@the.grey',
            'password' => 'youShallNotPass',
        ];
        User::factory()->createOne($credentials);
        $action = app(ApiLoginProxyForWebClientAction::class);

        $response = $action->run(PasswordGrantLoginProxy::create(
            $credentials['email'],
            $credentials['password'],
        ));

        $this->assertSame('refreshToken', $response->refreshTokenCookie->getName());
        $this->assertNotEmpty($response->token->accessToken);
    }
}
