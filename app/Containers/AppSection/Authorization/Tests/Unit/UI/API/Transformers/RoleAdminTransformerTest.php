<?php

declare(strict_types=1);

namespace App\Containers\AppSection\Authorization\Tests\Unit\UI\API\Transformers;

use App\Containers\AppSection\Authorization\Data\Factories\PermissionFactory;
use App\Containers\AppSection\Authorization\Data\Factories\RoleFactory;
use App\Containers\AppSection\Authorization\Tests\UnitTestCase;
use App\Containers\AppSection\Authorization\UI\API\Transformers\RoleAdminTransformer;
use PHPUnit\Framework\Attributes\CoversClass;

#[CoversClass(RoleAdminTransformer::class)]
final class RoleAdminTransformerTest extends UnitTestCase
{
    private RoleAdminTransformer $transformer;

    public function testCanTransformSingleObject(): void
    {
        $model = RoleFactory::new()->createOne();
        $expected = [
            'object'       => $model->getResourceKey(),
            'id'           => $model->getHashedKey(),
            'name'         => $model->name,
            'display_name' => $model->display_name,
            'guard_name'   => $model->guard_name,
            'description'  => $model->description,
        ];

        $transformedResource = $this->transformer->transform($model);

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
        $model = RoleFactory::new()->createOne();
        $permissions = PermissionFactory::new()->count(3)->create();
        $model->permissions()->attach($permissions);

        $collection = $this->transformer->includePermissions($model);

        $this->assertSame($model->permissions, $collection->getData());
    }

    #[\Override]
    protected function setUp(): void
    {
        parent::setUp();

        $this->transformer = new RoleAdminTransformer();
    }
}
