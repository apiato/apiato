<?php

namespace App\Ship\Tests\Unit\Exceptions;

use App\Ship\Exceptions\CreateResourceFailedException;
use App\Ship\Tests\ShipTestCase;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\Group;

#[Group('ship')]
#[CoversClass(CreateResourceFailedException::class)]
final class CreateResourceFailedExceptionTest extends ShipTestCase
{
    public function testException(): void
    {
        $this->expectExceptionCode(417);
        $this->expectExceptionMessage('Failed to create Resource.');

        throw new CreateResourceFailedException();
    }
}
