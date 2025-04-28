<?php

declare(strict_types=1);

namespace App\Containers\AppSection\Authorization\Tests\Unit\Models;

use Apiato\Core\Traits\ModelTrait;
use App\Containers\AppSection\Authorization\Data\Factories\PermissionFactory;
use App\Containers\AppSection\Authorization\Models\Permission;
use App\Containers\AppSection\Authorization\Tests\UnitTestCase;
use PHPUnit\Framework\Attributes\CoversClass;

#[CoversClass(Permission::class)]
final class PermissionTest extends UnitTestCase
{
    public function testUsesCorrectTraits(): void
    {
        $this->assertContains(ModelTrait::class, class_uses_recursive(Permission::class));
    }

    public function testUsesCorrectGuard(): void
    {
        $model = PermissionFactory::new()->createOne();
        $guard = 'api';

        $this->assertSame($guard, $this->getInaccessiblePropertyValue($model, 'guard_name'));
    }

    public function testHasCorrectFillableFields(): void
    {
        $model = PermissionFactory::new()->createOne();
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
        $model = PermissionFactory::new()->createOne();
        $table = 'permissions';

        $this->assertSame($table, $model->getTable());
    }

    public function testHasCorrectResourceKey(): void
    {
        $model = PermissionFactory::new()->createOne();

        $this->assertSame('Permission', $model->getResourceKey());
    }
}
