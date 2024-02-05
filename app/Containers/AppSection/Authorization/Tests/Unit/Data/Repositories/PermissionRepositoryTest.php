<?php

namespace App\Containers\AppSection\Authorization\Tests\Unit\Data\Repositories;

use App\Containers\AppSection\Authorization\Data\Repositories\PermissionRepository;
use App\Containers\AppSection\Authorization\Tests\UnitTestCase;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\Group;

#[Group('authorization')]
#[CoversClass(PermissionRepository::class)]
final class PermissionRepositoryTest extends UnitTestCase
{
    public function testRepositoryHasExpectedSearchableFieldsSet(): void
    {
        $data = [
            'name' => '=',
            'display_name' => 'like',
            'description' => 'like',
        ];
        $repository = app(PermissionRepository::class);

        $this->assertSame($data, $repository->getFieldsSearchable());
    }

    public function testReturnsCorrectModel(): void
    {
        $repository = app(PermissionRepository::class);

        $this->assertSame(config('permission.models.permission'), $repository->model());
    }
}
