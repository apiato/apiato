<?php

declare(strict_types=1);

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

        self::assertSame(strtolower($name), $permission->name);
        self::assertSame($description, $permission->description);
        self::assertSame($displayName, $permission->display_name);
        self::assertSame('api', $permission->guard_name);
    }
}
