<?php

namespace App\Containers\AppSection\Authorization\Tests\Unit\Actions;

use App\Containers\AppSection\Authorization\Actions\ListUserRolesAction;
use App\Containers\AppSection\Authorization\Data\Factories\RoleFactory;
use App\Containers\AppSection\Authorization\Tests\UnitTestCase;
use App\Containers\AppSection\Authorization\UI\API\Requests\ListUserRolesRequest;
use App\Containers\AppSection\User\Data\Factories\UserFactory;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\Group;

#[Group('authorization')]
#[CoversClass(ListUserRolesAction::class)]
final class ListUserRolesActionTest extends UnitTestCase
{
    public function testCanListRoles(): void
    {
        $user = UserFactory::new()->createOne()
            ->assignRole(RoleFactory::new()->count(3)->create());
        $request = ListUserRolesRequest::injectData()->withUrlParameters(['id' => $user->id]);
        $action = app(ListUserRolesAction::class);

        $result = $action->run($request);

        $this->assertCount(3, $result);
    }
}
