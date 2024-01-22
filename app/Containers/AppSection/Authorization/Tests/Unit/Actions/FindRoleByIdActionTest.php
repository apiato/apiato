<?php

namespace App\Containers\AppSection\Authorization\Tests\Unit\Actions;

use App\Containers\AppSection\Authorization\Actions\FindRoleByIdAction;
use App\Containers\AppSection\Authorization\Data\Factories\RoleFactory;
use App\Containers\AppSection\Authorization\Models\Role;
use App\Containers\AppSection\Authorization\Tests\UnitTestCase;
use App\Containers\AppSection\Authorization\UI\API\Requests\FindRoleByIdRequest;
use App\Ship\Exceptions\NotFoundException;
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
        $action = app(FindRoleByIdAction::class);

        $foundRole = $action->run($request);

        $this->assertSame($role->id, $foundRole->id);
    }

    public function testFindRoleWitInvalidIdThrows404(): void
    {
        $this->expectException(NotFoundException::class);

        $nonExistingID = 777777;
        $request = FindRoleByIdRequest::injectData()->withUrlParameters(['id' => $nonExistingID]);
        $action = app(FindRoleByIdAction::class);

        $action->run($request);
    }
}
