<?php

namespace App\Containers\AppSection\Authorization\Tests\Unit\Actions;

use App\Containers\AppSection\Authorization\Actions\AssignRolesToUserAction;
use App\Containers\AppSection\Authorization\Data\Factories\RoleFactory;
use App\Containers\AppSection\Authorization\Tests\UnitTestCase;
use App\Containers\AppSection\Authorization\UI\API\Requests\AssignRolesToUserRequest;
use App\Containers\AppSection\User\Data\Factories\UserFactory;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\Group;

#[Group('authorization')]
#[CoversClass(AssignRolesToUserAction::class)]
final class AssignRolesToUserActionTest extends UnitTestCase
{
    public function testCanAssignSingleRole(): void
    {
        $user = UserFactory::new()->createOne();
        $role = RoleFactory::new()->createOne();
        $data = [
            'user_id' => $user->getHashedKey(),
            'role_ids' => [$role->getHashedKey()],
        ];
        $request = AssignRolesToUserRequest::injectData($data);
        $action = app(AssignRolesToUserAction::class);

        $result = $action->run($request);

        $this->assertSame($result->id, $user->id);
        $this->assertTrue($result->hasRole($role->name));
    }

    public function testCanAssignMultipleRole(): void
    {
        $user = UserFactory::new()->createOne();
        $roleA = RoleFactory::new()->createOne();
        $roleB = RoleFactory::new()->createOne();
        $data = [
            'user_id' => $user->getHashedKey(),
            'role_ids' => [$roleA->getHashedKey(), $roleB->getHashedKey()],
        ];
        $request = AssignRolesToUserRequest::injectData($data);
        $action = app(AssignRolesToUserAction::class);

        $result = $action->run($request);

        $this->assertSame($result->id, $user->id);
        $this->assertTrue($result->hasAllRoles([$roleA->name, $roleB->name]));
    }
}
