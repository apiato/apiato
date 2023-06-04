<?php

namespace App\Containers\AppSection\Authentication\Tests\Unit;

use App\Containers\AppSection\Authentication\Exceptions\LoginFailedException;
use App\Containers\AppSection\Authentication\Tests\UnitTestCase;

/**
 * @group authentication
 * @group unit
 */
class LoginFailedExceptionTest extends UnitTestCase
{
    public function testLoginFailedException()
    {
        $this->expectExceptionCode(422);
        $this->expectExceptionMessage('An Exception happened during the Login Process.');

        throw new LoginFailedException();
    }
}
