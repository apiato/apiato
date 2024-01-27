<?php

namespace App\Ship\Tests\Unit\Exceptions;

use App\Ship\Exceptions\NotImplementedException;
use App\Ship\Tests\TestCase;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\Group;

#[Group('ship')]
#[CoversClass(NotImplementedException::class)]
final class NotImplementedExceptionTest extends TestCase
{
    public function testException(): void
    {
        $this->expectExceptionCode(501);
        $this->expectExceptionMessage('This method is not yet implemented.');

        throw new NotImplementedException();
    }
}
