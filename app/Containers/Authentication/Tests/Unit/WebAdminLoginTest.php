<?php

namespace App\Containers\Authentication\Tests\Unit;

use App\Containers\Authentication\Actions\WebAdminLoginAction;
use App\Containers\Authentication\UI\WEB\Requests\LoginRequest;
use App\Containers\Authorization\Exceptions\UserNotAdminException;
use App\Containers\User\Models\User;
use App\Containers\User\Tests\TestCase;
use Illuminate\Support\Facades\App;

/**
 * Class WebAdminLoginTest.
 *
 * @group authentication
 * @group unit
 *
 * @author Mohammad Alavi <mohammad.alavi1990@gmail.com>
 */
class WebAdminLoginTest extends TestCase
{
    private $userDetails;
    private $request;
    private $action;

    public function setUp(): void
    {
        parent::setUp();
        $this->userDetails = [
            'email' => 'Mahmoud@test.test',
            'password' => 'so-secret',
            'name' => 'Mahmoud',
        ];
        $this->request = new LoginRequest($this->userDetails);
        $this->action = App::make(WebAdminLoginAction::class);

    }

    public function testGivenAdminLoginCredentialsReturnsAnUser(): void
    {
        $this->getTestingUser($this->userDetails, ['roles' => 'admin']);
        $this->actingAs($this->testingUser, 'web');

        $user = $this->action->run($this->request);
        self::assertInstanceOf(User::class, $user);
    }

    public function testGivenUserIsNotAdminThrowAnException(): void
    {
        $this->expectException(UserNotAdminException::class);

        $this->getTestingUser($this->userDetails);
        $this->actingAs($this->testingUser, 'web');

        $this->action->run($this->request);
    }
}
