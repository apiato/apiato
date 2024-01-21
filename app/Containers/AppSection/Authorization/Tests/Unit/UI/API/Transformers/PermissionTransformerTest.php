<?php

namespace App\Containers\AppSection\Authorization\Tests\Unit\UI\API\Transformers;

use App\Containers\AppSection\Authorization\Data\Factories\PermissionFactory;
use App\Containers\AppSection\Authorization\Tests\UnitTestCase;
use App\Containers\AppSection\Authorization\UI\API\Transformers\PermissionTransformer;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\Group;

#[Group('authorization')]
#[CoversClass(PermissionTransformer::class)]
final class PermissionTransformerTest extends UnitTestCase
{
    private PermissionTransformer $transformer;

    public function testCanTransformSingleObject(): void
    {
        $permission = PermissionFactory::new()->createOne();
        $expected = [
            'object' => $permission->getResourceKey(),
            'id' => $permission->getHashedKey(),
            'name' => $permission->name,
            'display_name' => $permission->display_name,
            'description' => $permission->description,
        ];

        $transformedResource = $this->transformer->transform($permission);

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

    protected function setUp(): void
    {
        parent::setUp();
        $this->transformer = new PermissionTransformer();
    }
}
