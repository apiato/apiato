<?php

namespace App\Containers\AppSection\Authentication\Tests\Unit;

use App\Containers\AppSection\Authentication\Exceptions\RefreshTokenMissingException;
use App\Containers\AppSection\Authentication\Tests\UnitTestCase;

/**
 * @group authentication
 * @group unit
 */
class RefreshTokenMissingExceptionTest extends UnitTestCase
{
    public function testRefreshTokenMissedException()
    {
        $this->expectExceptionCode(400);
        $this->expectExceptionMessage('We could not find the Refresh Token. Maybe none is provided?');

        throw new RefreshTokenMissingException();
    }
}
