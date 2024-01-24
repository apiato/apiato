<?php

namespace App\Containers\AppSection\Authentication\Tests\Unit\Actions;

use App\Containers\AppSection\Authentication\Actions\ApiLoginProxyForWebClientAction;
use App\Containers\AppSection\Authentication\Tests\UnitTestCase;
use App\Containers\AppSection\Authentication\UI\API\Requests\LoginProxyPasswordGrantRequest;
use App\Containers\AppSection\Authentication\Values\AuthResult;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\Group;
use Symfony\Component\HttpFoundation\Cookie;

#[Group('authentication')]
#[CoversClass(ApiLoginProxyForWebClientAction::class)]
final class ApiLoginProxyForWebClientActionTest extends UnitTestCase
{
    public function testProxyApiLoginAction(): void
    {
        $credentials = [
            'email' => 'ganldalf@the.grey',
            'password' => 'youShallNotPass',
        ];
        $this->getTestingUser($credentials);
        $this->actingAs($this->testingUser, 'web');
        $request = LoginProxyPasswordGrantRequest::injectData($credentials);
        $action = app(ApiLoginProxyForWebClientAction::class);

        $response = $action->run($request);

        $this->assertSame('refreshToken', $response->refreshTokenCookie->getName());
    }
}
