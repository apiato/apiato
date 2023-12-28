<?php

namespace App\Containers\AppSection\Authentication\Tests\Unit\Exceptions;

use App\Containers\AppSection\Authentication\Exceptions\LoginFailedException;
use App\Containers\AppSection\Authentication\Tests\UnitTestCase;
use PHPUnit\Framework\Attributes\Group;

#[Group('authentication')]
class LoginFailedExceptionTest extends UnitTestCase
{
    public function testLoginFailedException(): void
    {
        $this->expectExceptionCode(422);
        $this->expectExceptionMessage('An Exception happened during the Login Process.');

        throw new LoginFailedException();
    }
}
