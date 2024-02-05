<?php

namespace App\Ship\Tests\Unit\Exceptions;

use App\Ship\Exceptions\ValidationFailedException;
use App\Ship\Tests\ShipTestCase;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\Group;

#[Group('ship')]
#[CoversClass(ValidationFailedException::class)]
final class ValidationFailedExceptionTest extends ShipTestCase
{
    public function testException(): void
    {
        $this->expectExceptionCode(422);
        $this->expectExceptionMessage('Invalid Input.');

        throw new ValidationFailedException();
    }
}
