<?php

namespace App\Containers\AppSection\User\Tests\Unit;

use App\Containers\AppSection\User\Tasks\FindUserByIdTask;
use App\Containers\AppSection\User\Tests\TestCase;
use App\Ship\Exceptions\NotFoundException;

/**
 * Class FindUserByIdTaskTest.
 *
 * @group user
 * @group unit
 */
class FindUserByIdTaskTest extends TestCase
{
    public function testFindUserWithInvalidId(): void
    {
        $this->expectException(NotFoundException::class);
        $this->expectExceptionMessage('The requested Resource was not found.');

        $noneExistingId = 777777;

        app(FindUserByIdTask::class)->run($noneExistingId);
    }
}
