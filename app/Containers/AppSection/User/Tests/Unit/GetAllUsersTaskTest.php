<?php

namespace App\Containers\AppSection\User\Tests\Unit;

use App\Containers\AppSection\User\Models\User;
use App\Containers\AppSection\User\Tasks\GetAllUsersTask;
use App\Containers\AppSection\User\Tests\UnitTestCase;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

/**
 * @group user
 * @group unit
 */
class GetAllUsersTaskTest extends UnitTestCase
{
    public function testGetAllUsers(): void
    {
        User::factory(2)->create();
        $task = app(GetAllUsersTask::class);

        $foundUsers = $task->run();

        $this->assertInstanceOf(LengthAwarePaginator::class, $foundUsers);
        $this->assertCount(3, $foundUsers);
    }
}
