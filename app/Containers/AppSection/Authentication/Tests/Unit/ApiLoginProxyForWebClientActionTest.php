<?php

namespace App\Containers\AppSection\Authentication\Tests\Unit;

use App\Containers\AppSection\Authentication\Actions\ApiLoginProxyForWebClientAction;
use App\Containers\AppSection\Authentication\Tests\UnitTestCase;
use App\Containers\AppSection\Authentication\UI\API\Requests\LoginProxyPasswordGrantRequest;
use Symfony\Component\HttpFoundation\Cookie;

/**
 * @group authentication
 * @group unit
 */
class ApiLoginProxyForWebClientActionTest extends UnitTestCase
{
    public function testProxyApiLoginAction()
    {
        $this->getTestingUser([
            'email' => 'ganldalf@the.grey',
            'password' => 'secret',
        ]);
        $this->actingAs($this->testingUser, 'web');
        $data = [
            'client_id' => $this->clientId,
            'client_password' => $this->clientSecret,
            'email' => 'ganldalf@the.grey',
            'password' => 'secret',
        ];
        $request = LoginProxyPasswordGrantRequest::injectData($data);
        $action = app(ApiLoginProxyForWebClientAction::class);

        $result = $action->run($request);

        $this->assertArrayHasKey('response_content', $result);
        $this->assertArrayHasKey('refresh_cookie', $result);
        $this->assertArrayHasKey('access_token', $result['response_content']);
        $this->assertArrayHasKey('token_type', $result['response_content']);
        $this->assertArrayHasKey('expires_in', $result['response_content']);
        $this->assertArrayHasKey('token_type', $result['response_content']);
        $this->assertEquals('Bearer', $result['response_content']['token_type']);
        $this->assertInstanceOf(Cookie::class, $result['refresh_cookie']);
        $this->assertEquals('refreshToken', $result['refresh_cookie']->getName());
    }
}
