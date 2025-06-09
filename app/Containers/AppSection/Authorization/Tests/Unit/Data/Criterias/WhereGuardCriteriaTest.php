<?php

declare(strict_types=1);

namespace App\Containers\AppSection\Authorization\Tests\Unit\Data\Criterias;

use App\Containers\AppSection\Authorization\Data\Criteria\WhereGuardCriteria;
use App\Containers\AppSection\Authorization\Data\Repositories\PermissionRepository;
use App\Containers\AppSection\Authorization\Data\Repositories\RoleRepository;
use App\Containers\AppSection\Authorization\Models\Permission;
use App\Containers\AppSection\Authorization\Models\Role;
use App\Containers\AppSection\Authorization\Tests\UnitTestCase;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\DataProvider;

#[CoversClass(WhereGuardCriteria::class)]
final class WhereGuardCriteriaTest extends UnitTestCase
{
    public static function authGuardDataProvider(): \Iterator
    {
        yield ['web'];
        yield ['api'];
    }

    #[DataProvider('authGuardDataProvider')]
    public function testWorksWithRoleModel(string $guard): void
    {
        Role::factory()->withGuard($guard)->count(2)->create();
        Role::factory()->withGuard(fake()->word())->createOne();
        $repository = app(RoleRepository::class);
        $criteria = app(WhereGuardCriteria::class, ['guard' => $guard]);
        $repository->pushCriteria($criteria);

        $result = $repository->all();

        self::assertCount(3, $result);
        self::assertEquals($guard, $result->first()->guard_name);
        self::assertEquals($guard, $result->last()->guard_name);
    }

    #[DataProvider('authGuardDataProvider')]
    public function testWorksWithPermissionModel(string $guard): void
    {
        Permission::factory()->withGuard($guard)->count(2)->create();
        Permission::factory()->withGuard(fake()->word())->createOne();
        $repository = app(PermissionRepository::class);
        $criteria = app(WhereGuardCriteria::class, ['guard' => $guard]);
        $repository->pushCriteria($criteria);

        $result = $repository->all();

        self::assertCount(2, $result);
        self::assertEquals($guard, $result->first()->guard_name);
        self::assertEquals($guard, $result->last()->guard_name);
    }
}
