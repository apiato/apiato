<?php

namespace App\Containers\AppSection\Authentication\Tests\Unit;

use App\Containers\AppSection\Authentication\Actions\RegisterUserAction;
use App\Containers\AppSection\Authentication\Notifications\VerifyEmail;
use App\Containers\AppSection\Authentication\Notifications\Welcome;
use App\Containers\AppSection\Authentication\Tests\UnitTestCase;
use App\Containers\AppSection\Authentication\UI\API\Requests\RegisterUserRequest;
use App\Containers\AppSection\User\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Notification;

/**
 * @group authentication
 * @group unit
 */
class RegisterUserActionTest extends UnitTestCase
{
    public function testRegisterUser(): void
    {
        Notification::fake();
        $data = [
            'email' => 'Mahmoud@test.test',
            'password' => 'so-secret',
            'verification_url' => config('appSection-authentication.allowed-verify-email-urls')[0],
        ];
        $request = RegisterUserRequest::injectData($data);
        $action = app(RegisterUserAction::class);

        $user = $action->run($request);

        $this->assertModelExists($user);
        $this->assertInstanceOf(User::class, $user);
        $this->assertEquals(strtolower($data['email']), $user->email);
        $this->assertTrue(Hash::check($data['password'], $user->password));
        $this->assertNull($user->email_verified_at);
        Notification::assertSentTo($user, Welcome::class);
        if (config('appSection-authentication.require_email_verification')) {
            Notification::assertSentTo($user, VerifyEmail::class);
        }
    }
}
