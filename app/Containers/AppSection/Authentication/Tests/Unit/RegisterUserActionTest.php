<?php

namespace App\Containers\AppSection\Authentication\Tests\Unit;

use App\Containers\AppSection\Authentication\Actions\RegisterUserAction;
use App\Containers\AppSection\Authentication\Notifications\VerifyEmail;
use App\Containers\AppSection\Authentication\Notifications\Welcome;
use App\Containers\AppSection\Authentication\Tests\TestCase;
use App\Containers\AppSection\Authentication\UI\API\Requests\RegisterUserRequest;
use Illuminate\Support\Facades\Notification;

/**
 * Class RegisterUserActionTest.
 *
 * @group authentication
 * @group unit
 */
class RegisterUserActionTest extends TestCase
{
    public function testSendNotification_AfterUserRegistration(): void
    {
        Notification::fake();

        $data = [
            'email' => 'Mahmoud@test.test',
            'password' => 'so-secret',
        ];

        $request = new RegisterUserRequest($data);
        $user = app(RegisterUserAction::class)->run($request);

        $this->assertEquals($data['email'], $user->email);
        Notification::assertSentTo($user, Welcome::class);

        if (config('appSection-authentication.require_email_verification')) {
            Notification::assertSentTo($user, VerifyEmail::class);
        }
    }
}
