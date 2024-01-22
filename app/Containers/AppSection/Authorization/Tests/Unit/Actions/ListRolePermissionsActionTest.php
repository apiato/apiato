<?php

namespace App\Containers\AppSection\Authorization\Tests\Unit\Actions;

use App\Containers\AppSection\Authorization\Actions\ListRolePermissionsAction;
use App\Containers\AppSection\Authorization\Data\Factories\PermissionFactory;
use App\Containers\AppSection\Authorization\Data\Factories\RoleFactory;
use App\Containers\AppSection\Authorization\Tests\UnitTestCase;
use App\Containers\AppSection\Authorization\UI\API\Requests\ListRolePermissionsRequest;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\Group;

#[Group('authorization')]
#[CoversClass(ListRolePermissionsAction::class)]
final class ListRolePermissionsActionTest extends UnitTestCase
{
    public function testCanListPermissions(): void
    {
        $role = RoleFactory::new()->createOne()
            ->givePermissionTo(PermissionFactory::new()->count(3)->create());
        $request = ListRolePermissionsRequest::injectData()->withUrlParameters(['id' => $role->id]);
        $action = app(ListRolePermissionsAction::class);

        $result = $action->run($request);

        $this->assertCount(3, $result);
    }
}
