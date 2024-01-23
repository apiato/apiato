<?php

namespace App\Containers\AppSection\Authorization\Tests\Unit\Actions;

use App\Containers\AppSection\Authorization\Actions\FindPermissionByIdAction;
use App\Containers\AppSection\Authorization\Data\Factories\PermissionFactory;
use App\Containers\AppSection\Authorization\Tests\UnitTestCase;
use App\Containers\AppSection\Authorization\UI\API\Requests\FindPermissionByIdRequest;
use App\Ship\Exceptions\NotFoundException;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\Group;

#[Group('authorization')]
#[CoversClass(FindPermissionByIdAction::class)]
final class FindPermissionByIdActionTest extends UnitTestCase
{
    public function testCanFindPermission(): void
    {
        $permission = PermissionFactory::new()->createOne();
        $request = FindPermissionByIdRequest::injectData()->withUrlParameters(['id' => $permission->id]);
        $action = app(FindPermissionByIdAction::class);

        $foundPermission = $action->run($request);

        $this->assertSame($permission->id, $foundPermission->id);
    }

    public function testFindPermissionWitInvalidIdThrows404(): void
    {
        $this->expectException(NotFoundException::class);

        $nonExistingID = 7777777;
        $request = FindPermissionByIdRequest::injectData()->withUrlParameters(['id' => $nonExistingID]);
        $action = app(FindPermissionByIdAction::class);

        $action->run($request);
    }
}
