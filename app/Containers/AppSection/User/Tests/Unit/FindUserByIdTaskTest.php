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
    public function testDeleteUserWithInvalidData(): void
    {
        $this->expectException(NotFoundException::class);
        $this->expectExceptionMessage('The requested Resource was not found.');

        app(FindUserByIdTask::class)->run('wrong-format-id');
    }
}
