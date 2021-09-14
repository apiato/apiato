<?php

namespace App\Containers\AppSection\Authentication\Tests\Unit;

use App\Containers\AppSection\Authentication\Actions\WebLoginAction;
use App\Containers\AppSection\Authentication\Exceptions\LoginFailedException;
use App\Containers\AppSection\Authentication\Exceptions\UserNotConfirmedException;
use App\Containers\AppSection\Authentication\UI\WEB\Requests\LoginRequest;
use App\Containers\AppSection\User\Models\User;
use App\Containers\AppSection\User\Tests\TestCase;
use Illuminate\Support\Facades\Config;

/**
 * Class WebLoginActionTest.
 *
 * @group authentication
 * @group unit
 */
class WebLoginActionTest extends TestCase
{
    private array $userDetails;
    private LoginRequest $request;
    private mixed $action;

    protected function setUp(): void
    {
        parent::setUp();
        $this->userDetails = [
            'email' => 'Mahmoud@test.test',
            'password' => 'so-secret',
            'name' => 'Mahmoud',
        ];
        $this->getTestingUser($this->userDetails);
        $this->actingAs($this->testingUser, 'web');
        $this->request = new LoginRequest($this->userDetails);
        $this->action = app(WebLoginAction::class);
    }

    public function testLogin(): void
    {
        $user = $this->action->run($this->request);

        $this->assertInstanceOf(User::class, $user);
        $this->assertSame($user->name, $this->userDetails['name']);
    }

    public function testLoginWithInvalidCredentialsThrowsAnException(): void
    {
        $this->expectException(LoginFailedException::class);
        $this->expectExceptionMessage('Invalid Login Credentials.');

        $this->request = new LoginRequest(['email' => 'wrong@email.com', 'password' => 'wrong_password']);

        $this->action->run($this->request);
    }

    public function testGivenEmailConfirmationIsRequiredAndUserIsNotConfirmedThrowsAnException(): void
    {
        $this->expectException(UserNotConfirmedException::class);

        $configInitialValue = config('appSection-authentication.require_email_confirmation');
        Config::set('appSection-authentication.require_email_confirmation', true);
        $this->testingUser->email_verified_at = null;
        $this->testingUser->save();

        $this->action->run($this->request);

        Config::set('appSection-authentication.require_email_confirmation', $configInitialValue);
    }
}
