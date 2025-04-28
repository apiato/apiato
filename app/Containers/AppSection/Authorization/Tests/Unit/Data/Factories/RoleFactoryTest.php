<?php

declare(strict_types=1);

namespace App\Containers\AppSection\Authorization\Tests\Unit\Data\Factories;

use App\Containers\AppSection\Authorization\Data\Factories\RoleFactory;
use App\Containers\AppSection\Authorization\Models\Role;
use App\Containers\AppSection\Authorization\Tests\UnitTestCase;
use App\Ship\Enums\AuthGuard;
use PHPUnit\Framework\Attributes\CoversClass;

#[CoversClass(RoleFactory::class)]
final class RoleFactoryTest extends UnitTestCase
{
    public function testCanCreateRole(): void
    {
        $model = RoleFactory::new()->createOne();

        $this->assertInstanceOf(Role::class, $model);
    }

    public function testCanCreateAdminRole(): void
    {
        // Since 'admin' is seeded in the database, we need to delete it first
        // to avoid "duplicate key" error.
        $roleName = config('appSection-authorization.admin_role');
        $adminRole = Role::findByName($roleName);
        $adminRole->delete();
        $this->assertModelMissing($adminRole);

        $model = RoleFactory::new()->admin()->createOne();

        $this->assertSame($roleName, $model->name);
    }

    public function testCanSetGuard(): void
    {
        $model = RoleFactory::new()->withGuard(AuthGuard::API->value)->createOne();

        $this->assertSame(AuthGuard::API->value, $model->guard_name);
    }
}
