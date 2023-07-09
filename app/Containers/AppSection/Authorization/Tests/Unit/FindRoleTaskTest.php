<?php

namespace App\Containers\AppSection\Authorization\Tests\Unit;

use App\Containers\AppSection\Authorization\Models\Role;
use App\Containers\AppSection\Authorization\Tasks\FindRoleTask;
use App\Containers\AppSection\Authorization\Tests\UnitTestCase;
use App\Ship\Exceptions\NotFoundException;

/**
 * @group authorization
 * @group unit
 */
class FindRoleTaskTest extends UnitTestCase
{
    public function testFindRoleById(): void
    {
        $role = Role::factory()->create();

        $result = app(FindRoleTask::class)->run($role->id);

        $this->assertEquals($role->id, $result->id);
    }

    public function testFindRoleByName(): void
    {
        $role = Role::factory()->create();

        $result = app(FindRoleTask::class)->run($role->name);

        $this->assertEquals($role->id, $result->id);
    }

    public function testFindRoleWithInvalidIdThrows404(): void
    {
        $this->expectException(NotFoundException::class);

        $invalidId = 7777;

        app(FindRoleTask::class)->run($invalidId);
    }
}
