<?php

declare(strict_types=1);

namespace App\Containers\AppSection\Authorization\Tests\Unit\Models;

use Apiato\Core\Models\InteractsWithApiato;
use App\Containers\AppSection\Authorization\Models\Role;
use App\Containers\AppSection\Authorization\Tests\UnitTestCase;
use PHPUnit\Framework\Attributes\CoversClass;

#[CoversClass(Role::class)]
final class RoleTest extends UnitTestCase
{
    public function testUsesCorrectTraits(): void
    {
        self::assertContains(InteractsWithApiato::class, class_uses_recursive(Role::class));
    }

    public function testHasCorrectFillableFields(): void
    {
        $role = Role::factory()->createOne();
        $fillables = [
            'name',
            'guard_name',
            'display_name',
            'description',
        ];

        foreach ($fillables as $fillable) {
            self::assertContains($fillable, $role->getFillable());
        }
    }

    public function testUsesCorrectTable(): void
    {
        $role = Role::factory()->createOne();
        $table = 'roles';

        self::assertSame($table, $role->getTable());
    }

    public function testHasCorrectResourceKey(): void
    {
        $role = Role::factory()->createOne();

        self::assertSame('Role', $role->getResourceKey());
    }
}
