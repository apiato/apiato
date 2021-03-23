<?php

namespace App\Containers\Authentication\Tests\Unit;

use App\Containers\Authentication\Actions\WebLoginSubAction;
use App\Containers\Authentication\Data\Transporters\LoginTransporter;
use App\Containers\Authentication\Exceptions\LoginFailedException;
use App\Containers\Authentication\Exceptions\UserNotConfirmedException;
use App\Containers\Authentication\UI\WEB\Requests\LoginRequest;
use App\Containers\User\Models\User;
use App\Containers\User\Tests\TestCase;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Config;

/**
 * Class LoginTest.
 *
 * @group authentication
 * @group unit
 */
class LoginTest extends TestCase
{
    private array $userDetails;
    private LoginRequest $request;
    private $action;

    public function setUp(): void
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
        $this->action = App::make(WebLoginSubAction::class);
    }

    public function testLogin(): void
    {
        $user = $this->action->run($this->request);

        self::assertInstanceOf(User::class, $user);
        self::assertSame($user->name, $this->userDetails['name']);
    }

    public function testLoginWithInvalidCredentialsThrowsAnException(): void
    {
        $this->expectException(LoginFailedException::class);

        $this->request = new LoginRequest(['email' => 'wrong@email.com', 'password' => 'wrong_password']);
        $this->action->run($this->request);
    }

    public function testGivenEmailConfirmationIsRequiredAndUserIsNotConfirmedThrowsAnException(): void
    {
        $this->expectException(UserNotConfirmedException::class);

        $configInitialValue = Config::get('authentication-container.require_email_confirmation');
        Config::set('authentication-container.require_email_confirmation', true);

        $this->testingUser->confirmed = false;
        $this->testingUser->save();

        $this->action->run($this->request);

        Config::set('authentication-container.require_email_confirmation', $configInitialValue);
    }
}
