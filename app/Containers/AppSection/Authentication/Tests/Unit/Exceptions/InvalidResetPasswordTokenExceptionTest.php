<?php

declare(strict_types=1);

namespace App\Containers\AppSection\Authentication\Tests\Unit\Exceptions;

use App\Containers\AppSection\Authentication\Exceptions\InvalidResetPasswordTokenException;
use App\Containers\AppSection\Authentication\Tests\UnitTestCase;
use PHPUnit\Framework\Attributes\CoversClass;

#[CoversClass(InvalidResetPasswordTokenException::class)]
final class InvalidResetPasswordTokenExceptionTest extends UnitTestCase
{
    public function testLoginFailedException(): void
    {
        $this->expectExceptionCode(403);
        $this->expectExceptionMessage('Invalid Reset Password Token Provided.');

        throw new InvalidResetPasswordTokenException();
    }
}
