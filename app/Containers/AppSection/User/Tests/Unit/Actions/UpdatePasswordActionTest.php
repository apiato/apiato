<?php

namespace App\Containers\AppSection\User\Tests\Unit\Actions;

use App\Containers\AppSection\User\Actions\UpdatePasswordAction;
use App\Containers\AppSection\User\Data\Factories\UserFactory;
use App\Containers\AppSection\User\Notifications\PasswordUpdatedNotification;
use App\Containers\AppSection\User\Tests\UnitTestCase;
use App\Containers\AppSection\User\UI\API\Requests\UpdatePasswordRequest;
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
            'new_password' => 'test',
        ];
        $request = UpdatePasswordRequest::injectData($data, $user)->withUrlParameters(['id' => $user->id]);
        $action = app(UpdatePasswordAction::class);

        $result = $action->run($request);

        $this->assertTrue(Hash::check($data['new_password'], $result->password));
        Notification::assertSentTo($user, PasswordUpdatedNotification::class);
    }
}
