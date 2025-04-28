<?php

declare(strict_types=1);

namespace App\Containers\AppSection\Authorization\Tests\Unit\UI\API\Transformers;

use App\Containers\AppSection\Authorization\Data\Factories\PermissionFactory;
use App\Containers\AppSection\Authorization\Tests\UnitTestCase;
use App\Containers\AppSection\Authorization\UI\API\Transformers\PermissionTransformer;
use PHPUnit\Framework\Attributes\CoversClass;

#[CoversClass(PermissionTransformer::class)]
final class PermissionTransformerTest extends UnitTestCase
{
    private PermissionTransformer $transformer;

    public function testCanTransformSingleObject(): void
    {
        $model = PermissionFactory::new()->createOne();
        $expected = [
            'object'       => $model->getResourceKey(),
            'id'           => $model->getHashedKey(),
            'name'         => $model->name,
            'display_name' => $model->display_name,
            'description'  => $model->description,
        ];

        $transformedResource = $this->transformer->transform($model);

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

    #[\Override]
    protected function setUp(): void
    {
        parent::setUp();

        $this->transformer = new PermissionTransformer();
    }
}
