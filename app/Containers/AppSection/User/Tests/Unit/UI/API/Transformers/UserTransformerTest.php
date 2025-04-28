<?php

declare(strict_types=1);

namespace App\Containers\AppSection\User\Tests\Unit\UI\API\Transformers;

use App\Containers\AppSection\Authorization\Data\Factories\PermissionFactory;
use App\Containers\AppSection\Authorization\Data\Factories\RoleFactory;
use App\Containers\AppSection\User\Data\Factories\UserFactory;
use App\Containers\AppSection\User\Tests\UnitTestCase;
use App\Containers\AppSection\User\UI\API\Transformers\UserTransformer;
use PHPUnit\Framework\Attributes\CoversClass;

#[CoversClass(UserTransformer::class)]
final class UserTransformerTest extends UnitTestCase
{
    private UserTransformer $transformer;

    public function testCanTransformSingleObject(): void
    {
        $model = UserFactory::new()->createOne();
        $expected = [
            'object'            => $model->getResourceKey(),
            'id'                => $model->getHashedKey(),
            'name'              => $model->name,
            'email'             => $model->email,
            'email_verified_at' => $model->email_verified_at,
            'gender'            => $model->gender,
            'birth'             => $model->birth,
        ];

        $transformedResource = $this->transformer->transform($model);

        $this->assertEquals($expected, $transformedResource);
    }

    public function testAvailableIncludes(): void
    {
        $this->assertSame([
            'roles',
            'permissions',
        ], $this->transformer->getAvailableIncludes());
    }

    public function testDefaultIncludes(): void
    {
        $this->assertSame([], $this->transformer->getDefaultIncludes());
    }

    public function testIncludeRoles(): void
    {
        $model = UserFactory::new()->createOne();
        $roles = RoleFactory::new()->count(3)->create();
        $model->roles()->attach($roles);

        $collection = $this->transformer->includeRoles($model);

        $this->assertSame($model->roles, $collection->getData());
    }

    public function testIncludePermissions(): void
    {
        $model = UserFactory::new()->createOne();
        $permissions = PermissionFactory::new()->count(3)->create();
        $model->permissions()->attach($permissions);

        $collection = $this->transformer->includePermissions($model);

        $this->assertSame($model->permissions, $collection->getData());
    }

    #[\Override]
    protected function setUp(): void
    {
        parent::setUp();

        $this->transformer = new UserTransformer();
    }
}
