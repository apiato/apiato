<?php

namespace App\Containers\AppSection\Authorization\Tests\Unit\Actions;

use App\Containers\AppSection\Authorization\Actions\FindPermissionByIdAction;
use App\Containers\AppSection\Authorization\Data\Factories\PermissionFactory;
use App\Containers\AppSection\Authorization\Data\Repositories\PermissionRepository;
use App\Containers\AppSection\Authorization\Tests\UnitTestCase;
use App\Containers\AppSection\Authorization\UI\API\Requests\FindPermissionByIdRequest;
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
        $repositoryMock = $this->partialMock(PermissionRepository::class);
        $repositoryMock->expects('getById')->once()->with($request->id)->andReturn($permission);

        app(FindPermissionByIdAction::class)->run($request);
    }
}
