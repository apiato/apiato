<?php

namespace App\Containers\AppSection\Authentication\Tests\Unit\Actions;

use App\Containers\AppSection\Authentication\Actions\RegisterUserAction;
use App\Containers\AppSection\Authentication\Notifications\VerifyEmail;
use App\Containers\AppSection\Authentication\Notifications\Welcome;
use App\Containers\AppSection\Authentication\Tests\UnitTestCase;
use App\Containers\AppSection\Authentication\UI\API\Requests\RegisterUserRequest;
use App\Containers\AppSection\User\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Notification;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\Group;

#[Group('authentication')]
#[CoversClass(RegisterUserAction::class)]
final class RegisterUserActionTest extends UnitTestCase
{
    public function testRegisterUser(): void
    {
        Notification::fake();
        $data = [
            'email' => 'gandalf@the.grey',
            'password' => 'youShallNotPass',
            'verification_url' => config('appSection-authentication.allowed-verify-email-urls')[0],
        ];
        $request = RegisterUserRequest::injectData($data);
        $action = app(RegisterUserAction::class);

        $user = $action->run($request);

        $this->assertModelExists($user);
        $this->assertInstanceOf(User::class, $user);
        $this->assertSame(strtolower($data['email']), $user->email);
        $this->assertTrue(Hash::check($data['password'], $user->password));
        $this->assertNull($user->email_verified_at);
        Notification::assertSentTo($user, Welcome::class);
        if (config('appSection-authentication.require_email_verification')) {
            Notification::assertSentTo($user, VerifyEmail::class);
        }
    }
}
