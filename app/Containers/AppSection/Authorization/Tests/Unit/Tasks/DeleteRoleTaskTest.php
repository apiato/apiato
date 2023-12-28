<?php

namespace App\Containers\AppSection\Authorization\Tests\Unit\Tasks;

use App\Containers\AppSection\Authorization\Data\Factories\RoleFactory;
use App\Containers\AppSection\Authorization\Tasks\DeleteRoleTask;
use App\Containers\AppSection\Authorization\Tests\UnitTestCase;
use App\Ship\Exceptions\NotFoundException;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\Group;

#[Group('authorization')]
#[CoversClass(DeleteRoleTask::class)]
class DeleteRoleTaskTest extends UnitTestCase
{
    public function testSuccessfulDeleteRoleShouldReturn1(): void
    {
        $role = RoleFactory::new()->create(['name' => 'testRole']);

        $result = app(DeleteRoleTask::class)->run($role->id);

        $this->assertEquals(1, $result);
        $this->assertDatabaseMissing(config('permission.table_names.roles'), $role->toArray());
    }

    public function testDeleteRoleWitInvalidIdThrows404(): void
    {
        $this->expectException(NotFoundException::class);

        $invalidId = 7777;

        app(DeleteRoleTask::class)->run($invalidId);
    }
}
