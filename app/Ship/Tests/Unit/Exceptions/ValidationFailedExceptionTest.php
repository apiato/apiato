<?php

declare(strict_types=1);

namespace App\Ship\Tests\Unit\Exceptions;

use App\Ship\Exceptions\ValidationFailedException;
use App\Ship\Tests\ShipTestCase;
use PHPUnit\Framework\Attributes\CoversClass;

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
