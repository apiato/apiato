<?php

namespace App\Containers\AppSection\Authentication\Tests\Unit\Exceptions;

use App\Containers\AppSection\Authentication\Exceptions\LoginFailedException;
use App\Containers\AppSection\Authentication\Tests\UnitTestCase;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\Group;
use Symfony\Component\HttpFoundation\Response;

#[Group('authentication')]
#[CoversClass(LoginFailedException::class)]
final class LoginFailedExceptionTest extends UnitTestCase
{
    public function testLoginFailedException(): void
    {
        $this->expectExceptionCode(Response::HTTP_UNAUTHORIZED);
        $this->expectExceptionMessage('Invalid credentials.');

        throw new LoginFailedException();
    }
}
