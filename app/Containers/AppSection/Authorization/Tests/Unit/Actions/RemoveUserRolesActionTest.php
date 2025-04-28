<?php

declare(strict_types=1);

namespace App\Containers\AppSection\Authorization\Tests\Unit\Actions;

use App\Containers\AppSection\Authorization\Actions\RemoveUserRolesAction;
use App\Containers\AppSection\Authorization\Data\Factories\RoleFactory;
use App\Containers\AppSection\Authorization\Tests\UnitTestCase;
use App\Containers\AppSection\Authorization\UI\API\Requests\RemoveUserRolesRequest;
use App\Containers\AppSection\User\Data\Factories\UserFactory;
use PHPUnit\Framework\Attributes\CoversClass;

#[CoversClass(RemoveUserRolesAction::class)]
final class RemoveUserRolesActionTest extends UnitTestCase
{
    public function testCanRemoveRole(): void
    {
        $model = UserFactory::new()->createOne();
        $roles = RoleFactory::new()->count(3)->create();
        $model->assignRole($roles);
        $removeUserRolesRequest = RemoveUserRolesRequest::injectData([
            'role_ids' => $roles[1]->getHashedKey(),
        ])->withUrlParameters(['user_id' => $model->id]);
        $action = app(RemoveUserRolesAction::class);

        $result = $action->run($removeUserRolesRequest);

        $this->assertCount(2, $result->roles);
        $this->assertSame($roles[0]->id, $result->roles->first()->id);
        $this->assertSame($roles[2]->id, $result->roles->last()->id);
    }

    public function testCanRemoveRoles(): void
    {
        $model = UserFactory::new()->createOne();
        $roles = RoleFactory::new()->count(3)->create();
        $model->assignRole($roles);
        $removeUserRolesRequest = RemoveUserRolesRequest::injectData([
            'role_ids' => [$roles[0]->getHashedKey(), $roles[2]->getHashedKey()],
        ])->withUrlParameters(['user_id' => $model->id]);
        $action = app(RemoveUserRolesAction::class);

        $result = $action->run($removeUserRolesRequest);

        $this->assertCount(1, $result->roles);
        $this->assertSame($roles[1]->id, $result->roles->sole()->id);
    }
}
