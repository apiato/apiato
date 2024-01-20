<?php

namespace App\Containers\AppSection\User\Tests\Unit\Tasks;

use App\Containers\AppSection\User\Data\Factories\UserFactory;
use App\Containers\AppSection\User\Tasks\ListUsersTask;
use App\Containers\AppSection\User\Tests\UnitTestCase;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\Group;

#[Group('user')]
#[CoversClass(ListUsersTask::class)]
final class ListUsersTaskTest extends UnitTestCase
{
    public function testListUsers(): void
    {
        UserFactory::new()->count(2)->create();
        $task = app(ListUsersTask::class);

        $foundUsers = $task->run();

        $this->assertInstanceOf(LengthAwarePaginator::class, $foundUsers);
        $this->assertCount(3, $foundUsers);
    }
}
