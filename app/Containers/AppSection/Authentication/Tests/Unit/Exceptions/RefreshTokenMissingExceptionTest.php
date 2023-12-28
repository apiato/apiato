<?php

namespace App\Containers\AppSection\Authentication\Tests\Unit\Exceptions;

use App\Containers\AppSection\Authentication\Exceptions\RefreshTokenMissingException;
use App\Containers\AppSection\Authentication\Tests\UnitTestCase;
use PHPUnit\Framework\Attributes\Group;

#[Group('authentication')]
class RefreshTokenMissingExceptionTest extends UnitTestCase
{
    public function testRefreshTokenMissedException(): void
    {
        $this->expectExceptionCode(400);
        $this->expectExceptionMessage('We could not find the Refresh Token. Maybe none is provided?');

        throw new RefreshTokenMissingException();
    }
}
