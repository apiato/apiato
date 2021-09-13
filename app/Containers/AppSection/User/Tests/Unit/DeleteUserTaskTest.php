<?php

namespace App\Containers\AppSection\User\Tests\Unit;

use App\Containers\AppSection\User\Tasks\DeleteUserTask;
use App\Containers\AppSection\User\Tests\TestCase;
use App\Ship\Exceptions\DeleteResourceFailedException;

/**
 * Class DeleteUserTaskTest.
 *
 * @group user
 * @group unit
 */
class DeleteUserTaskTest extends TestCase
{
    public function testDeleteUserWithInvalidData(): void
    {
        $this->expectException(DeleteResourceFailedException::class);
        $this->expectExceptionMessage('Failed to delete Resource.');

        app(DeleteUserTask::class)->run('wrong-format-id');
    }
}
