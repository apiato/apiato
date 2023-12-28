<?php

namespace App\Containers\AppSection\Authorization\Tests\Unit\Tasks;

use App\Containers\AppSection\Authorization\Data\Factories\PermissionFactory;
use App\Containers\AppSection\Authorization\Tasks\FindPermissionTask;
use App\Containers\AppSection\Authorization\Tests\UnitTestCase;
use App\Ship\Exceptions\NotFoundException;
use PHPUnit\Framework\Attributes\Group;

#[Group('authorization')]
class FindPermissionTaskTest extends UnitTestCase
{
    public function testFindPermissionById(): void
    {
        $permission = PermissionFactory::new()->createOne();

        $result = app(FindPermissionTask::class)->run($permission->id);

        $this->assertEquals($permission->id, $result->id);
    }

    public function testFindPermissionByName(): void
    {
        $permission = PermissionFactory::new()->createOne();

        $result = app(FindPermissionTask::class)->run($permission->name);

        $this->assertEquals($permission->id, $result->id);
    }

    public function testFindPermissionWithInvalidIdThrows404(): void
    {
        $this->expectException(NotFoundException::class);

        $invalidId = 7777;

        app(FindPermissionTask::class)->run($invalidId);
    }
}
