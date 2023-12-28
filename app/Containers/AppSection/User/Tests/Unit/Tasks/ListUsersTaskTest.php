<?php

namespace App\Containers\AppSection\User\Tests\Unit\Tasks;

use App\Containers\AppSection\User\Data\Factories\UserFactory;
use App\Containers\AppSection\User\Tasks\ListUsersTask;
use App\Containers\AppSection\User\Tests\UnitTestCase;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

/**
 * @group user
 * @group unit
 */
class ListUsersTaskTest extends UnitTestCase
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
