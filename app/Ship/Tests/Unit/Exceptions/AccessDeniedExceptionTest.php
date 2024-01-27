<?php

namespace App\Ship\Tests\Unit\Exceptions;

use App\Ship\Exceptions\AccessDeniedException;
use App\Ship\Tests\TestCase;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\Group;

#[Group('ship')]
#[CoversClass(AccessDeniedException::class)]
final class AccessDeniedExceptionTest extends TestCase
{
    public function testException(): void
    {
        $this->expectExceptionCode(403);
        $this->expectExceptionMessage('This action is unauthorized.');

        throw new AccessDeniedException();
    }
}
