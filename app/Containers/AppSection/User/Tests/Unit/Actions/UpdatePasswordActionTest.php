<?php

namespace App\Containers\AppSection\User\Tests\Unit\Actions;

use App\Containers\AppSection\User\Actions\UpdatePasswordAction;
use App\Containers\AppSection\User\Data\Factories\UserFactory;
use App\Containers\AppSection\User\Data\Resources\UserResource;
use App\Containers\AppSection\User\Notifications\PasswordUpdatedNotification;
use App\Containers\AppSection\User\Tests\UnitTestCase;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Notification;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\Group;

#[Group('user')]
#[CoversClass(UpdatePasswordAction::class)]
final class UpdatePasswordActionTest extends UnitTestCase
{
    public function testCanUpdateCurrentPassword(): void
    {
        Notification::fake();
        $user = UserFactory::new()->createOne(['password' => 'youShallNotPass']);
        $data = [
            'user_id' => $user->id,
            'password' => 'test',
        ];
        $userData = UserResource::from($data);
        $action = app(UpdatePasswordAction::class);

        $result = $action->run($userData);

        $this->assertTrue(Hash::check($data['password'], $result->password));
        Notification::assertSentTo($user, PasswordUpdatedNotification::class);
    }
}
