<?php

namespace App\Containers\AppSection\SocialAuth\Tests\Unit\UI\API\Controllers;

use App\Containers\AppSection\SocialAuth\Actions\SocialLoginAction;
use App\Containers\AppSection\SocialAuth\Tests\UnitTestCase;
use App\Containers\AppSection\SocialAuth\UI\API\Controllers\SocialAuthController;
use App\Containers\AppSection\SocialAuth\UI\API\Requests\AccessTokenLoginRequest;

class AuthenticateAllControllerTest extends UnitTestCase
{
    public function testControllerCallsCorrectAction(): void
    {
        $request = AccessTokenLoginRequest::injectData();
        $actionMock = $this->mock(SocialLoginAction::class);
        $actionMock->expects('run')->once()->with($request)->andReturn([
            'user' => [],
            'token' => $this->mockPersonalAccessTokenResult(),
        ]);
        $controller = app(SocialAuthController::class, [
            'socialLoginAction' => $actionMock,
        ]);

        $controller->__invoke($request);
    }
}
