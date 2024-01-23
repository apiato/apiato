<?php

namespace App\Containers\AppSection\Authentication\Tests\Unit\Actions;

use App\Containers\AppSection\Authentication\Actions\WebLoginAction;
use App\Containers\AppSection\Authentication\Tests\UnitTestCase;
use App\Containers\AppSection\Authentication\UI\WEB\Requests\LoginRequest;
use App\Containers\AppSection\User\Data\Factories\UserFactory;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\Group;

#[Group('authentication')]
#[CoversClass(WebLoginAction::class)]
final class WebLoginActionTest extends UnitTestCase
{
    public function testCanLogin(): void
    {
        $userDetails = [
            'email' => 'gandalf@the.grey',
            'password' => 'youShallNotPass',
            'name' => 'Mahmoud',
        ];
        $this->testingUser = UserFactory::new()->createOne($userDetails);
        $request = LoginRequest::injectData($userDetails);
        $action = app(WebLoginAction::class);

        $response = $action->run($request);

        $this->assertTrue($response->isRedirect());
        $this->assertAuthenticatedAs($this->testingUser, 'web');
        // TODO: add unit test for this
        // $this->assertSame('The provided credentials do not match our records.', $response->getSession()->get('email'));
    }
}
