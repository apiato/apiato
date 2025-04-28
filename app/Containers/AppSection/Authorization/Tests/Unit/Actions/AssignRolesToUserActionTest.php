<?php

declare(strict_types=1);

namespace App\Containers\AppSection\Authorization\Tests\Unit\Actions;

use App\Containers\AppSection\Authorization\Actions\AssignRolesToUserAction;
use App\Containers\AppSection\Authorization\Data\Factories\RoleFactory;
use App\Containers\AppSection\Authorization\Tests\UnitTestCase;
use App\Containers\AppSection\Authorization\UI\API\Requests\AssignRolesToUserRequest;
use App\Containers\AppSection\User\Data\Factories\UserFactory;
use PHPUnit\Framework\Attributes\CoversClass;

#[CoversClass(AssignRolesToUserAction::class)]
final class AssignRolesToUserActionTest extends UnitTestCase
{
    public function testCanAssignSingleRole(): void
    {
        $model = UserFactory::new()->createOne();
        $role = RoleFactory::new()->createOne();
        $data = [
            'user_id'  => $model->getHashedKey(),
            'role_ids' => [$role->getHashedKey()],
        ];
        $assignRolesToUserRequest = AssignRolesToUserRequest::injectData($data)
            ->withUrlParameters(['user_id' => $model->id]);
        $action = app(AssignRolesToUserAction::class);

        $result = $action->run($assignRolesToUserRequest);

        $this->assertSame($result->id, $model->id);
        $this->assertTrue($result->hasRole($role->name));
    }

    public function testCanAssignMultipleRole(): void
    {
        $model = UserFactory::new()->createOne();
        $roleA = RoleFactory::new()->createOne();
        $roleB = RoleFactory::new()->createOne();
        $data = [
            'user_id'  => $model->getHashedKey(),
            'role_ids' => [$roleA->getHashedKey(), $roleB->getHashedKey()],
        ];
        $assignRolesToUserRequest = AssignRolesToUserRequest::injectData($data)
            ->withUrlParameters(['user_id' => $model->id]);
        $action = app(AssignRolesToUserAction::class);

        $result = $action->run($assignRolesToUserRequest);

        $this->assertSame($result->id, $model->id);
        $this->assertTrue($result->hasAllRoles([$roleA->name, $roleB->name]));
    }
}
