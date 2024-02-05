<?php

namespace App\Containers\AppSection\Authorization\Tests\Unit\UI\API\Transformers;

use App\Containers\AppSection\Authorization\Data\Factories\PermissionFactory;
use App\Containers\AppSection\Authorization\Data\Factories\RoleFactory;
use App\Containers\AppSection\Authorization\Tests\UnitTestCase;
use App\Containers\AppSection\Authorization\UI\API\Transformers\RoleAdminTransformer;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\Group;

#[Group('authorization')]
#[CoversClass(RoleAdminTransformer::class)]
final class RoleAdminTransformerTest extends UnitTestCase
{
    private RoleAdminTransformer $transformer;

    public function testCanTransformSingleObject(): void
    {
        $role = RoleFactory::new()->createOne();
        $expected = [
            'object' => $role->getResourceKey(),
            'id' => $role->getHashedKey(),
            'name' => $role->name,
            'display_name' => $role->display_name,
            'guard_name' => $role->guard_name,
            'description' => $role->description,
        ];

        $transformedResource = $this->transformer->transform($role);

        $this->assertEquals($expected, $transformedResource);
    }

    public function testAvailableIncludes(): void
    {
        $this->assertSame([
            'permissions',
        ], $this->transformer->getAvailableIncludes());
    }

    public function testDefaultIncludes(): void
    {
        $this->assertSame([], $this->transformer->getDefaultIncludes());
    }

    public function testIncludePermissions(): void
    {
        $role = RoleFactory::new()->createOne();
        $permissions = PermissionFactory::new()->count(3)->create();
        $role->permissions()->attach($permissions);

        $resource = $this->transformer->includePermissions($role);

        $this->assertSame($role->permissions, $resource->getData());
    }

    protected function setUp(): void
    {
        parent::setUp();
        $this->transformer = new RoleAdminTransformer();
    }
}
