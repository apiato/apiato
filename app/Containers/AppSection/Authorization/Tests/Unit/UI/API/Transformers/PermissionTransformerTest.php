<?php

declare(strict_types=1);

namespace App\Containers\AppSection\Authorization\Tests\Unit\UI\API\Transformers;

use App\Containers\AppSection\Authorization\Models\Permission;
use App\Containers\AppSection\Authorization\Tests\UnitTestCase;
use App\Containers\AppSection\Authorization\UI\API\Transformers\PermissionTransformer;
use PHPUnit\Framework\Attributes\CoversClass;

#[CoversClass(PermissionTransformer::class)]
final class PermissionTransformerTest extends UnitTestCase
{
    private PermissionTransformer $transformer;

    public function testCanTransformSingleObject(): void
    {
        $permission = Permission::factory()->createOne();
        $expected = [
            'type'         => $permission->getResourceKey(),
            'id'           => $permission->getHashedKey(),
            'name'         => $permission->name,
            'display_name' => $permission->display_name,
            'description'  => $permission->description,
        ];

        $transformedResource = $this->transformer->transform($permission);

        self::assertEquals($expected, $transformedResource);
    }

    public function testAvailableIncludes(): void
    {
        self::assertSame([
            'roles',
        ], $this->transformer->getAvailableIncludes());
    }

    public function testDefaultIncludes(): void
    {
        self::assertSame([], $this->transformer->getDefaultIncludes());
    }

    protected function setUp(): void
    {
        parent::setUp();

        $this->transformer = new PermissionTransformer();
    }
}
