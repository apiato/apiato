<?php

namespace App\Containers\AppSection\Authorization\Tests\Unit\Tasks;

use App\Containers\AppSection\Authorization\Tasks\CreatePermissionTask;
use App\Containers\AppSection\Authorization\Tests\UnitTestCase;
use PHPUnit\Framework\Attributes\CoversClass;

#[CoversClass(CreatePermissionTask::class)]
final class CreatePermissionTaskTest extends UnitTestCase
{
    public function testCreatePermission(): void
    {
        $name = 'fuLl_coNtroL';
        $description = 'Gives full control of everything!';
        $displayName = 'Controller of All';

        $permission = app(CreatePermissionTask::class)->run($name, $description, $displayName);

        $this->assertSame(strtolower($name), $permission->name);
        $this->assertSame($description, $permission->description);
        $this->assertSame($displayName, $permission->display_name);
        $this->assertSame('api', $permission->guard_name);
    }
}
