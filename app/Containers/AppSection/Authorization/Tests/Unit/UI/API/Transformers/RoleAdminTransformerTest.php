<?php

declare(strict_types=1);

namespace App\Containers\AppSection\Authorization\Tests\Unit\UI\API\Transformers;

use App\Containers\AppSection\Authorization\Models\Permission;
use App\Containers\AppSection\Authorization\Models\Role;
use App\Containers\AppSection\Authorization\Tests\UnitTestCase;
use App\Containers\AppSection\Authorization\UI\API\Transformers\RoleAdminTransformer;
use PHPUnit\Framework\Attributes\CoversClass;

#[CoversClass(RoleAdminTransformer::class)]
final class RoleAdminTransformerTest extends UnitTestCase
{
    private RoleAdminTransformer $transformer;

    public function testCanTransformSingleObject(): void
    {
        $role = Role::factory()->createOne();
        $expected = [
            'type'         => $role->getResourceKey(),
            'id'           => $role->getHashedKey(),
            'name'         => $role->name,
            'display_name' => $role->display_name,
            'guard_name'   => $role->guard_name,
            'description'  => $role->description,
        ];

        $transformedResource = $this->transformer->transform($role);

        self::assertEquals($expected, $transformedResource);
    }

    public function testAvailableIncludes(): void
    {
        self::assertSame([
            'permissions',
        ], $this->transformer->getAvailableIncludes());
    }

    public function testDefaultIncludes(): void
    {
        self::assertSame([], $this->transformer->getDefaultIncludes());
    }

    public function testIncludePermissions(): void
    {
        $role = Role::factory()->createOne();
        $permissions = Permission::factory()->count(3)->create();
        $role->permissions()->attach($permissions);

        $resource = $this->transformer->includePermissions($role);

        self::assertSame($role->permissions, $resource->getData());
    }

    protected function setUp(): void
    {
        parent::setUp();

        $this->transformer = new RoleAdminTransformer();
    }
}
