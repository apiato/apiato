<?php

namespace App\Containers\AppSection\Authentication\Tests\Unit\Actions;

use App\Containers\AppSection\Authentication\Actions\ApiLoginProxyForWebClientAction;
use App\Containers\AppSection\Authentication\Tests\UnitTestCase;
use App\Containers\AppSection\Authentication\UI\API\Requests\LoginProxyPasswordGrantRequest;
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
            'password' => 'secret',
        ];
        $this->getTestingUser($credentials);
        $this->actingAs($this->testingUser, 'web');

        $request = LoginProxyPasswordGrantRequest::injectData($credentials);
        $action = app(ApiLoginProxyForWebClientAction::class);

        $result = $action->run($request);

        $this->assertArrayHasKey('response_content', $result);
        $this->assertArrayHasKey('refresh_cookie', $result);
        $this->assertArrayHasKey('access_token', $result['response_content']);
        $this->assertArrayHasKey('token_type', $result['response_content']);
        $this->assertArrayHasKey('expires_in', $result['response_content']);
        $this->assertArrayHasKey('token_type', $result['response_content']);
        $this->assertSame('Bearer', $result['response_content']['token_type']);
        $this->assertInstanceOf(Cookie::class, $result['refresh_cookie']);
        $this->assertSame('refreshToken', $result['refresh_cookie']->getName());
    }
}
