<?php

namespace App\Containers\AppSection\User\Tests\Unit;

use App\Containers\AppSection\User\Actions\RegisterUserAction;
use App\Containers\AppSection\User\Notifications\UserRegisteredNotification;
use App\Containers\AppSection\User\Tests\TestCase;
use App\Containers\AppSection\User\UI\API\Requests\RegisterUserRequest;
use Illuminate\Support\Facades\Notification;

/**
 * Class RegisterUserActionTest.
 *
 * @group user
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

        Notification::assertSentTo($user, UserRegisteredNotification::class);
    }
}
