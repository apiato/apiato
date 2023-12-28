<?php

namespace App\Containers\AppSection\Authentication\Tests\Unit\Actions;

use App\Containers\AppSection\Authentication\Actions\ApiLogoutAction;
use App\Containers\AppSection\Authentication\Tests\UnitTestCase;
use App\Containers\AppSection\Authentication\UI\API\Requests\LogoutRequest;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\Group;

#[Group('authentication')]
#[CoversClass(ApiLogoutAction::class)]
class ApiLogoutActionTest extends UnitTestCase
{
    public function testApiLogoutAction(): void
    {
        $data = [
            'email' => 'gandalf@the.grey',
            'password' => 'youShallNotPass',
        ];
        $this->getTestingUser($data);
        $accessToken = $this->createAccessTokenFor($data['email'], $data['password']);
        $request = LogoutRequest::injectData(server: ['HTTP_AUTHORIZATION' => 'Bearer ' . $accessToken]);
        $action = app(ApiLogoutAction::class);

        $action->run($request);

        $this->assertTrue(true);
    }
}
