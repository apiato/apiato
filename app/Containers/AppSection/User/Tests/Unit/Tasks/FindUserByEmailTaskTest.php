<?php

declare(strict_types=1);

namespace App\Containers\AppSection\User\Tests\Unit\Tasks;

use App\Containers\AppSection\User\Data\Factories\UserFactory;
use App\Containers\AppSection\User\Tasks\FindUserByEmailTask;
use App\Containers\AppSection\User\Tests\UnitTestCase;
use App\Ship\Exceptions\NotFoundException;
use PHPUnit\Framework\Attributes\CoversClass;

#[CoversClass(FindUserByEmailTask::class)]
final class FindUserByEmailTaskTest extends UnitTestCase
{
    public function testFindUserByEmail(): void
    {
        $model = UserFactory::new()->createOne();

        $foundUser = app(FindUserByEmailTask::class)->run($model->email);

        $this->assertSame($model->email, $foundUser->email);
    }

    public function testFindUserWithInvalidEmail(): void
    {
        $this->expectException(NotFoundException::class);

        $noneExistingEmail = 'gandalf@the.grey';

        app(FindUserByEmailTask::class)->run($noneExistingEmail);
    }
}
