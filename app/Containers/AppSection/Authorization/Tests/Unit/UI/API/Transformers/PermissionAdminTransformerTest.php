<?php

declare(strict_types=1);

namespace App\Containers\AppSection\Authorization\Tests\Unit\UI\API\Transformers;

use App\Containers\AppSection\Authorization\Data\Factories\PermissionFactory;
use App\Containers\AppSection\Authorization\Data\Factories\RoleFactory;
use App\Containers\AppSection\Authorization\Tests\UnitTestCase;
use App\Containers\AppSection\Authorization\UI\API\Transformers\PermissionAdminTransformer;
use PHPUnit\Framework\Attributes\CoversClass;

#[CoversClass(PermissionAdminTransformer::class)]
final class PermissionAdminTransformerTest extends UnitTestCase
{
    private PermissionAdminTransformer $transformer;

    public function testCanTransformSingleObject(): void
    {
        $model = PermissionFactory::new()->createOne();
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
        $this->assertSame([], $this->transformer->getAvailableIncludes());
    }

    public function testDefaultIncludes(): void
    {
        $this->assertSame([], $this->transformer->getDefaultIncludes());
    }

    public function testIncludeRoles(): void
    {
        $model = PermissionFactory::new()->createOne();
        $roles = RoleFactory::new()->count(3)->create();
        $model->roles()->attach($roles);

        $collection = $this->transformer->includeRoles($model);

        $this->assertSame($model->roles, $collection->getData());
    }

    #[\Override]
    protected function setUp(): void
    {
        parent::setUp();

        $this->transformer = new PermissionAdminTransformer();
    }
}
