<?php

namespace App\Containers\AppSection\Authentication\Tests\Unit\Tasks;

use App\Containers\AppSection\Authentication\Tasks\MakeRefreshTokenCookieTask;
use App\Containers\AppSection\Authentication\Tests\UnitTestCase;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\Group;

#[Group('authentication')]
#[CoversClass(MakeRefreshTokenCookieTask::class)]
final class MakeRefreshCookieTaskTest extends UnitTestCase
{
    public function testMakeRefreshCookie(): void
    {
        $refreshToken = 'some-random-refresh-token';
        $task = app(MakeRefreshTokenCookieTask::class);

        $result = $task->run($refreshToken);

        // TODO: this should cover more cases
        $this->assertSame($result->getName(), 'refreshToken');
        $this->assertSame($result->getValue(), $refreshToken);
        $this->assertSame($result->isHttpOnly(), true);
    }
}
