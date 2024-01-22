<?php

namespace App\Containers\AppSection\Authorization\Tests\Unit\UI\API\Transformers;

use App\Containers\AppSection\Authorization\Data\Factories\PermissionFactory;
use App\Containers\AppSection\Authorization\Data\Factories\RoleFactory;
use App\Containers\AppSection\Authorization\Tests\UnitTestCase;
use App\Containers\AppSection\Authorization\UI\API\Transformers\PermissionAdminTransformer;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\Group;

#[Group('authorization')]
#[CoversClass(PermissionAdminTransformer::class)]
final class PermissionAdminTransformerTest extends UnitTestCase
{
    private PermissionAdminTransformer $transformer;

    public function testCanTransformSingleObject(): void
    {
        $permission = PermissionFactory::new()->createOne();
        $expected = [
            'object' => $permission->getResourceKey(),
            'id' => $permission->getHashedKey(),
            'name' => $permission->name,
            'display_name' => $permission->display_name,
            'guard_name' => $permission->guard_name,
            'description' => $permission->description,
        ];

        $transformedResource = $this->transformer->transform($permission);

        $this->assertEquals($expected, $transformedResource);
    }

    public function testAvailableIncludes(): void
    {
        $this->assertSame([
            'roles',
        ], $this->transformer->getAvailableIncludes());
    }

    public function testDefaultIncludes(): void
    {
        $this->assertSame([], $this->transformer->getDefaultIncludes());
    }

    public function testIncludeRoles(): void
    {
        $permission = PermissionFactory::new()->createOne();
        $roles = RoleFactory::new()->count(3)->create();
        $permission->roles()->attach($roles);

        $resource = $this->transformer->includeRoles($permission);

        $this->assertSame($permission->roles, $resource->getData());
    }

    protected function setUp(): void
    {
        parent::setUp();
        $this->transformer = new PermissionAdminTransformer();
    }
}
