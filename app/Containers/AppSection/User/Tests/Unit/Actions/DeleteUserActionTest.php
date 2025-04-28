<?php

declare(strict_types=1);

namespace App\Containers\AppSection\User\Tests\Unit\Actions;

use App\Containers\AppSection\User\Actions\DeleteUserAction;
use App\Containers\AppSection\User\Data\Factories\UserFactory;
use App\Containers\AppSection\User\Tests\UnitTestCase;
use App\Containers\AppSection\User\UI\API\Requests\DeleteUserRequest;
use PHPUnit\Framework\Attributes\CoversClass;

#[CoversClass(DeleteUserAction::class)]
final class DeleteUserActionTest extends UnitTestCase
{
    public function testCanDeleteUser(): void
    {
        $model = UserFactory::new()->createOne();
        $deleteUserRequest = DeleteUserRequest::injectData()->withUrlParameters(['user_id' => $model->id]);
        $action = app(DeleteUserAction::class);

        $result = $action->run($deleteUserRequest);

        $this->assertTrue($result);
        $this->assertModelMissing($model);
    }
}
