<?php

namespace App\Ship\Tests\Unit\Exceptions;

use App\Ship\Exceptions\InternalErrorException;
use App\Ship\Tests\ShipTestCase;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\Group;

#[Group('ship')]
#[CoversClass(InternalErrorException::class)]
final class InternalErrorExceptionTest extends ShipTestCase
{
    public function testException(): void
    {
        $this->expectExceptionCode(500);
        $this->expectExceptionMessage('Something went wrong!');

        throw new InternalErrorException();
    }
}
