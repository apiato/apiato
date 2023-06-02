<?php

namespace App\Containers\AppSection\Authentication\Tests\Unit;

use App\Containers\AppSection\Authentication\Actions\ApiLogoutAction;
use App\Containers\AppSection\Authentication\Tests\UnitTestCase;
use App\Containers\AppSection\Authentication\UI\API\Requests\LogoutRequest;

/**
 * @group authentication
 * @group unit
 */
class ApiLogoutActionTest extends UnitTestCase
{
    public function testApiLogoutAction()
    {
        $data = [
            'email' => 'gandalf@the.grey',
            'password' => 'youShallNotPass',
        ];
        $this->getTestingUser($data);
        $accessToken = $this->createAccessToken($data['email'], $data['password']);
        $request = LogoutRequest::injectData(server: ['HTTP_AUTHORIZATION' => 'Bearer ' . $accessToken]);
        $action = app(ApiLogoutAction::class);

        $response = $action->run($request);

        $this->assertNull($response);
    }
}
