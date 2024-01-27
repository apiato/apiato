<?php

namespace App\Containers\AppSection\Authorization\Tests\Unit\Data\Criterias;

use App\Containers\AppSection\Authorization\Data\Criterias\WhereGuardCriteria;
use App\Containers\AppSection\Authorization\Data\Factories\PermissionFactory;
use App\Containers\AppSection\Authorization\Data\Factories\RoleFactory;
use App\Containers\AppSection\Authorization\Data\Repositories\PermissionRepository;
use App\Containers\AppSection\Authorization\Data\Repositories\RoleRepository;
use App\Containers\AppSection\Authorization\Tests\UnitTestCase;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\Attributes\Group;

#[Group('authorization')]
#[CoversClass(WhereGuardCriteria::class)]
final class WhereGuardCriteriaTest extends UnitTestCase
{
    #[DataProvider('authGuardDataProvider')]
    public function testWorksWithRoleModel(string $guard): void
    {
        RoleFactory::new()->withGuard($guard)->count(2)->create();
        RoleFactory::new()->withGuard(fake()->word())->createOne();
        $repository = app(RoleRepository::class);
        $criteria = app(WhereGuardCriteria::class, compact('guard'));
        $repository->pushCriteria($criteria);

        $result = $repository->all();

        $this->assertCount(3, $result);
        $this->assertEquals($guard, $result->first()->guard_name);
        $this->assertEquals($guard, $result->last()->guard_name);
    }

    #[DataProvider('authGuardDataProvider')]
    public function testWorksWithPermissionModel(string $guard): void
    {
        PermissionFactory::new()->withGuard($guard)->count(2)->create();
        PermissionFactory::new()->withGuard(fake()->word())->createOne();
        $repository = app(PermissionRepository::class);
        $criteria = app(WhereGuardCriteria::class, compact('guard'));
        $repository->pushCriteria($criteria);

        $result = $repository->all();

        $this->assertCount(7, $result);
        $this->assertEquals($guard, $result->first()->guard_name);
        $this->assertEquals($guard, $result->last()->guard_name);
    }
}
