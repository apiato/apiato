<?php

namespace App\Containers\AppSection\Authentication\Tests\Unit;

use App\Containers\AppSection\Authentication\Actions\ApiRefreshProxyForWebClientAction;
use App\Containers\AppSection\Authentication\Tests\UnitTestCase;
use App\Containers\AppSection\Authentication\UI\API\Requests\RefreshProxyRequest;

/**
 * @group authentication
 * @group unit
 */
class ApiRefreshProxyForWebClientActionTest extends UnitTestCase
{
    public function testProxyApiRefresh()
    {
        $data = [
            'email' => 'gandalf@the.grey',
            'password' => 'youShallNotPass',
        ];
        $this->getTestingUser($data);
        $request = RefreshProxyRequest::injectData([
            'refresh_token' => $this->createRefreshToken($data['email'], $data['password']),
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
