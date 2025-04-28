<?php

declare(strict_types=1);

namespace App\Containers\AppSection\Authorization\Tests\Unit\UI\API\Transformers;

use App\Containers\AppSection\Authorization\Data\Factories\RoleFactory;
use App\Containers\AppSection\Authorization\Tests\UnitTestCase;
use App\Containers\AppSection\Authorization\UI\API\Transformers\RoleTransformer;
use PHPUnit\Framework\Attributes\CoversClass;

#[CoversClass(RoleTransformer::class)]
final class RoleTransformerTest extends UnitTestCase
{
    private RoleTransformer $transformer;

    public function testCanTransformSingleObject(): void
    {
        $model = RoleFactory::new()->createOne();
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
            'permissions',
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

        $this->transformer = new RoleTransformer();
    }
}
