<?php

declare(strict_types=1);

namespace App\Containers\AppSection\Authentication\Tests\Unit\Exceptions;

use App\Containers\AppSection\Authentication\Exceptions\InvalidEmailVerificationDataException;
use App\Containers\AppSection\Authentication\Tests\UnitTestCase;
use PHPUnit\Framework\Attributes\CoversClass;

#[CoversClass(InvalidEmailVerificationDataException::class)]
final class InvalidEmailVerificationDataExceptionTest extends UnitTestCase
{
    public function testLoginFailedException(): void
    {
        $this->expectExceptionCode(422);
        $this->expectExceptionMessage('Invalid Email Verification Data Provided.');

        throw new InvalidEmailVerificationDataException();
    }
}
