<?php

declare(strict_types=1);

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

        self::assertSame($role->id, $result->id);
    }

    public function testFindRoleByName(): void
    {
        $role = Role::factory()->createOne();

        $result = app(FindRoleTask::class)->run($role->name);

        self::assertSame($role->id, $result->id);
    }
}
