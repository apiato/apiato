<?php

namespace App\Containers\AppSection\User\Tests\Unit;

use App\Containers\AppSection\User\Models\User;
use App\Containers\AppSection\User\Tasks\DeleteUserTask;
use App\Containers\AppSection\User\Tests\UnitTestCase;
use App\Ship\Exceptions\NotFoundException;

/**
 * @group user
 * @group unit
 */
class DeleteUserTaskTest extends UnitTestCase
{
    public function testDeleteUser(): void
    {
        $user = User::factory()->create();

        $result = app(DeleteUserTask::class)->run($user->id);

        $this->assertEquals(1, $result);
    }

    public function testDeleteUserWithInvalidId(): void
    {
        $this->expectException(NotFoundException::class);

        $noneExistingId = 777777;

        app(DeleteUserTask::class)->run($noneExistingId);
    }
}
