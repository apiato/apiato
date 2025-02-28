<?php

namespace App\Containers\AppSection\Authentication\Tests\Unit\Actions\Web;

use App\Containers\AppSection\Authentication\Actions\Web\LoginAction;
use App\Containers\AppSection\Authentication\Tests\UnitTestCase;
use App\Containers\AppSection\Authentication\UI\WEB\Controllers\HomePageController;
use App\Containers\AppSection\User\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\MessageBag;
use PHPUnit\Framework\Attributes\CoversClass;

#[CoversClass(LoginAction::class)]
final class LoginActionTest extends UnitTestCase
{
    public function testCanLoginWithCredentials(): void
    {
        $user = User::factory()->createOne([
            'email' => 'gandalf@the.grey',
            'password' => 'youShallNotPass',
        ]);
        $action = app(LoginAction::class);

        $result = $action->run('gandalf@the.grey', 'youShallNotPass', false);

        $this->assertAuthenticatedAs($user, 'web');
        $this->assertTrue($result->isRedirect(action(HomePageController::class)));
    }

    public function testCanReturnErrors(): void
    {
        $credentials = [
            'email' => 'gandalf@the.grey',
            'password' => 'youShallNotPass',
        ];
        User::factory()->createOne($credentials);
        $authSpy = Auth::spy();
        $authSpy->allows()->guard('web')->andReturnSelf();
        $authSpy->allows()->attempt($credentials)->andReturn(false);
        $action = app(LoginAction::class);

        $response = $action->run('gandalf@the.grey', 'youShallNotPass', false);

        /** @var MessageBag $errors */
        $errors = $response->getSession()->get('errors');
        $field = 'email';
        $this->assertTrue($errors->has($field));
        $this->assertCount(1, $errors->get($field));
        $this->assertSame(__('auth.failed'), $errors->get($field)[0]);
        $this->assertTrue($response->isRedirect());
    }
}
