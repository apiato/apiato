<?php

namespace App\Containers\AppSection\User\Tests\Unit\Actions;

use App\Containers\AppSection\User\Actions\UpdatePasswordAction;
use App\Containers\AppSection\User\Models\User;
use App\Containers\AppSection\User\Notifications\PasswordUpdatedNotification;
use App\Containers\AppSection\User\Tests\UnitTestCase;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Notification;
use PHPUnit\Framework\Attributes\CoversClass;

#[CoversClass(UpdatePasswordAction::class)]
final class UpdatePasswordActionTest extends UnitTestCase
{
    public function testCanUpdateCurrentPassword(): void
    {
        Notification::fake();
        $user = User::factory()->createOne(['password' => 'youShallNotPass']);
        $action = app(UpdatePasswordAction::class);

        $result = $action->run($user->id, 'test');

        $this->assertTrue(Hash::check('test', $result->password));
        Notification::assertSentTo($user, PasswordUpdatedNotification::class);
    }
}
