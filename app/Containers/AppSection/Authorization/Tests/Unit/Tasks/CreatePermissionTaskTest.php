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
        $display_name = 'Controller of All';

        $permission = app(CreatePermissionTask::class)->run($name, $description, $display_name);

        $this->assertSame(strtolower($name), $permission->name);
        $this->assertSame($description, $permission->description);
        $this->assertSame($display_name, $permission->display_name);
        $this->assertSame('api', $permission->guard_name);
    }
}
