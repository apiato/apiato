<?php

namespace App\Containers\AppSection\Authentication\Tests\Unit;

use App\Containers\AppSection\Authentication\Actions\WebLoginAction;
use App\Containers\AppSection\Authentication\Exceptions\LoginFailedException;
use App\Containers\AppSection\Authentication\Tests\TestCase;
use App\Containers\AppSection\Authentication\UI\WEB\Requests\LoginRequest;
use App\Containers\AppSection\User\Models\User;

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
}
