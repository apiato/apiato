<?php

namespace App\Containers\AppSection\Authorization\Tests\Unit\Tasks;

use App\Containers\AppSection\Authorization\Data\Factories\RoleFactory;
use App\Containers\AppSection\Authorization\Tasks\FindRoleTask;
use App\Containers\AppSection\Authorization\Tests\UnitTestCase;
use App\Ship\Exceptions\NotFoundException;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\Group;

#[Group('authorization')]
#[CoversClass(FindRoleTask::class)]
final class FindRoleTaskTest extends UnitTestCase
{
    public function testFindRoleById(): void
    {
        $role = RoleFactory::new()->createOne();

        $result = app(FindRoleTask::class)->run($role->id);

        $this->assertSame($role->id, $result->id);
    }

    public function testFindRoleByName(): void
    {
        $role = RoleFactory::new()->createOne();

        $result = app(FindRoleTask::class)->run($role->name);

        $this->assertSame($role->id, $result->id);
    }

    public function testFindRoleWithInvalidIdThrows404(): void
    {
        $this->expectException(NotFoundException::class);

        $invalidId = 7777777;

        app(FindRoleTask::class)->run($invalidId);
    }
}
