<?php

namespace App\Containers\AppSection\Authentication\Tests\Unit;

use App\Containers\AppSection\Authentication\Tasks\MakeRefreshCookieTask;
use App\Containers\AppSection\Authentication\Tests\UnitTestCase;

/**
 * @group authentication
 * @group unit
 */
class MakeRefreshCookieTaskTest extends UnitTestCase
{
    public function testMakeRefreshCookie()
    {
        $refreshToken = 'some-random-refresh-token';
        $task = app(MakeRefreshCookieTask::class);

        $result = $task->run($refreshToken);

        // TODO: this should cover more cases
        $this->assertEquals($result->getName(), 'refreshToken');
        $this->assertEquals($result->getValue(), $refreshToken);
        $this->assertEquals($result->isHttpOnly(), true);
    }
}
