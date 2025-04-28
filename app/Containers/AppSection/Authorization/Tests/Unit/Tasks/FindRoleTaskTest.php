<?php

declare(strict_types=1);

namespace App\Containers\AppSection\Authorization\Tests\Unit\Tasks;

use App\Containers\AppSection\Authorization\Data\Factories\RoleFactory;
use App\Containers\AppSection\Authorization\Tasks\FindRoleTask;
use App\Containers\AppSection\Authorization\Tests\UnitTestCase;
use App\Ship\Exceptions\NotFoundException;
use PHPUnit\Framework\Attributes\CoversClass;

#[CoversClass(FindRoleTask::class)]
final class FindRoleTaskTest extends UnitTestCase
{
    public function testFindRoleById(): void
    {
        $model = RoleFactory::new()->createOne();

        $result = app(FindRoleTask::class)->run($model->id);

        $this->assertSame($model->id, $result->id);
    }

    public function testFindRoleByName(): void
    {
        $model = RoleFactory::new()->createOne();

        $result = app(FindRoleTask::class)->run($model->name);

        $this->assertSame($model->id, $result->id);
    }

    public function testFindRoleWithInvalidIdThrows404(): void
    {
        $this->expectException(NotFoundException::class);

        $invalidId = 7777777;

        app(FindRoleTask::class)->run($invalidId);
    }
}
