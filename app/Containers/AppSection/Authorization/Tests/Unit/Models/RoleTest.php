<?php

declare(strict_types=1);

namespace App\Containers\AppSection\Authorization\Tests\Unit\Models;

use Apiato\Core\Traits\ModelTrait;
use App\Containers\AppSection\Authorization\Data\Factories\RoleFactory;
use App\Containers\AppSection\Authorization\Models\Role;
use App\Containers\AppSection\Authorization\Tests\UnitTestCase;
use PHPUnit\Framework\Attributes\CoversClass;

#[CoversClass(Role::class)]
final class RoleTest extends UnitTestCase
{
    public function testUsesCorrectTraits(): void
    {
        $this->assertContains(ModelTrait::class, class_uses_recursive(Role::class));
    }

    public function testUsesCorrectGuard(): void
    {
        $model = RoleFactory::new()->createOne();
        $guard = 'api';

        $this->assertSame($guard, $this->getInaccessiblePropertyValue($model, 'guard_name'));
    }

    public function testHasCorrectFillableFields(): void
    {
        $model = RoleFactory::new()->createOne();
        $fillables = [
            'name',
            'guard_name',
            'display_name',
            'description',
        ];

        foreach ($fillables as $fillable) {
            $this->assertContains($fillable, $model->getFillable());
        }
    }

    public function testUsesCorrectTable(): void
    {
        $model = RoleFactory::new()->createOne();
        $table = 'roles';

        $this->assertSame($table, $model->getTable());
    }

    public function testHasCorrectResourceKey(): void
    {
        $model = RoleFactory::new()->createOne();

        $this->assertSame('Role', $model->getResourceKey());
    }
}
