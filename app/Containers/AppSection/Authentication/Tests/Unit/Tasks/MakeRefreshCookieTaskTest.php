<?php

namespace App\Containers\AppSection\Authentication\Tests\Unit\Tasks;

use App\Containers\AppSection\Authentication\Tasks\MakeRefreshTokenCookieTask;
use App\Containers\AppSection\Authentication\Tests\UnitTestCase;
use PHPUnit\Framework\Attributes\CoversClass;

#[CoversClass(MakeRefreshTokenCookieTask::class)]
final class MakeRefreshCookieTaskTest extends UnitTestCase
{
    public function testMakeRefreshCookie(): void
    {
        $this->freezeTime();
        $refreshToken = 'some-random-refresh-token';
        $task = app(MakeRefreshTokenCookieTask::class);

        $result = $task->run($refreshToken);

        $this->assertSame('refreshToken', $result->getName());
        $this->assertSame($refreshToken, $result->getValue());
        $this->assertEquals((int)config('appSection-authentication.refresh-tokens-expire-in'), $result->getExpiresTime());
        $this->assertEquals('/', $result->getPath());
        $this->assertNull($result->getDomain());
        $this->assertEquals(config('session.secure'), $result->isSecure());
        $this->assertEquals(config('session.http_only'), $result->isHttpOnly());
    }
}
