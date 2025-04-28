<?php

declare(strict_types=1);

namespace App\Containers\AppSection\User\Tests\Unit\Actions;

use App\Containers\AppSection\User\Actions\UpdatePasswordAction;
use App\Containers\AppSection\User\Data\Factories\UserFactory;
use App\Containers\AppSection\User\Notifications\PasswordUpdatedNotification;
use App\Containers\AppSection\User\Tests\UnitTestCase;
use App\Containers\AppSection\User\UI\API\Requests\UpdatePasswordRequest;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Notification;
use PHPUnit\Framework\Attributes\CoversClass;

#[CoversClass(UpdatePasswordAction::class)]
final class UpdatePasswordActionTest extends UnitTestCase
{
    public function testCanUpdateCurrentPassword(): void
    {
        Notification::fake();
        $model = UserFactory::new()->createOne(['password' => 'youShallNotPass']);
        $data = [
            'user_id'  => $model->id,
            'password' => 'test',
        ];
        $updatePasswordRequest = UpdatePasswordRequest::injectData($data, $model)->withUrlParameters(['user_id' => $model->id]);
        $action = app(UpdatePasswordAction::class);

        $result = $action->run($updatePasswordRequest);

        $this->assertTrue(Hash::check($data['password'], $result->password));
        Notification::assertSentTo($model, PasswordUpdatedNotification::class);
    }
}
