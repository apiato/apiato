<?php

namespace App\Containers\AppSection\Authentication\Tests\Unit\Actions;

use App\Containers\AppSection\Authentication\Actions\ApiRefreshProxyForWebClientAction;
use App\Containers\AppSection\Authentication\Tests\UnitTestCase;
use App\Containers\AppSection\Authentication\UI\API\Requests\RefreshProxyRequest;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\Group;

#[Group('authentication')]
#[CoversClass(ApiRefreshProxyForWebClientAction::class)]
class ApiRefreshProxyForWebClientActionTest extends UnitTestCase
{
    public function testProxyApiRefresh(): void
    {
        $data = [
            'email' => 'gandalf@the.grey',
            'password' => 'youShallNotPass',
        ];
        $this->getTestingUser($data);
        $request = RefreshProxyRequest::injectData([
            'refresh_token' => $this->createRefreshTokenFor($data['email'], $data['password']),
        ]);
        $action = app(ApiRefreshProxyForWebClientAction::class);

        $response = $action->run($request);

        $this->assertArrayHasKey('response_content', $response);
        $this->assertArrayHasKey('refresh_cookie', $response);
        $this->assertArrayHasKey('access_token', $response['response_content']);
        $this->assertArrayHasKey('refresh_token', $response['response_content']);
        $this->assertArrayHasKey('expires_in', $response['response_content']);
        $this->assertArrayHasKey('token_type', $response['response_content']);
        $this->assertEquals('Bearer', $response['response_content']['token_type']);
    }
}
