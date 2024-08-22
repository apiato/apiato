<?php

namespace App\Containers\AppSection\User\Tests\Unit\Data\Repositories;

use App\Containers\AppSection\User\Data\Repositories\UserRepository;
use App\Containers\AppSection\User\Tests\UnitTestCase;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\Group;

#[Group('user')]
#[CoversClass(UserRepository::class)]
final class UserRepositoryTest extends UnitTestCase
{
    public function testRepositoryHasExpectedSearchableFieldsSet(): void
    {
        $data = [
            'id' => '=',
            'name' => 'like',
            'email' => '=',
            'email_verified_at' => 'like',
            'created_at' => 'like',
        ];
        $repository = app(UserRepository::class);

        $this->assertSame($data, $repository->getFieldsSearchable());
    }

    public function testReturnsCorrectModel(): void
    {
        $repository = app(UserRepository::class);

        $this->assertSame(config('auth.providers.users.model'), $repository->model());
    }
}
