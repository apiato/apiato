<?php

namespace App\Containers\AppSection\Authorization\Tests\Unit\Actions;

use App\Containers\AppSection\Authorization\Actions\FindRoleByIdAction;
use App\Containers\AppSection\Authorization\Data\Factories\RoleFactory;
use App\Containers\AppSection\Authorization\Tasks\FindRoleTask;
use App\Containers\AppSection\Authorization\Tests\UnitTestCase;
use App\Containers\AppSection\Authorization\UI\API\Requests\FindRoleByIdRequest;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\Group;

#[Group('authorization')]
#[CoversClass(FindRoleByIdAction::class)]
final class FindRoleByIdActionTest extends UnitTestCase
{
    public function testCanFindRole(): void
    {
        $role = RoleFactory::new()->createOne();
        $request = FindRoleByIdRequest::injectData()->withUrlParameters(['id' => $role->id]);
        $taskMock = $this->partialMock(FindRoleTask::class);
        $taskMock->expects('run')->once()->with($request->id)->andReturn($role);

        app(FindRoleByIdAction::class)->run($request);
    }
}
