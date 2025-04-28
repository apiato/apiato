<?php

declare(strict_types=1);

namespace App\Containers\AppSection\Authorization\Tests\Unit\Data\Repositories;

use App\Containers\AppSection\Authorization\Data\Repositories\RoleRepository;
use App\Containers\AppSection\Authorization\Tests\UnitTestCase;
use PHPUnit\Framework\Attributes\CoversClass;

#[CoversClass(RoleRepository::class)]
final class RoleRepositoryTest extends UnitTestCase
{
    public function testRepositoryHasExpectedSearchableFieldsSet(): void
    {
        $data = [
            'name'         => '=',
            'display_name' => 'like',
            'description'  => 'like',
        ];
        $repository = app(RoleRepository::class);

        $this->assertSame($data, $repository->getFieldsSearchable());
    }

    public function testReturnsCorrectModel(): void
    {
        $repository = app(RoleRepository::class);

        $this->assertSame(config('permission.models.role'), $repository->model());
    }
}
