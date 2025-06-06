<?php

namespace App\Containers\AppSection\Authorization\Tests\Unit\Tasks;

use App\Containers\AppSection\Authorization\Models\Role;
use App\Containers\AppSection\Authorization\Tasks\FindRoleTask;
use App\Containers\AppSection\Authorization\Tests\UnitTestCase;
use PHPUnit\Framework\Attributes\CoversClass;

#[CoversClass(FindRoleTask::class)]
final class FindRoleTaskTest extends UnitTestCase
{
    public function testFindRoleById(): void
    {
        $role = Role::factory()->createOne();

        $result = app(FindRoleTask::class)->run($role->id);

        $this->assertSame($role->id, $result->id);
    }

    public function testFindRoleByName(): void
    {
        $role = Role::factory()->createOne();

        $result = app(FindRoleTask::class)->run($role->name);

        $this->assertSame($role->id, $result->id);
    }
}
