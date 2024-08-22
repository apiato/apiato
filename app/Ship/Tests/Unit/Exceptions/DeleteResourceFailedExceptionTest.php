<?php

namespace App\Ship\Tests\Unit\Exceptions;

use App\Ship\Exceptions\DeleteResourceFailedException;
use App\Ship\Tests\ShipTestCase;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\Group;

#[Group('ship')]
#[CoversClass(DeleteResourceFailedException::class)]
final class DeleteResourceFailedExceptionTest extends ShipTestCase
{
    public function testException(): void
    {
        $this->expectExceptionCode(417);
        $this->expectExceptionMessage('Failed to delete Resource.');

        throw new DeleteResourceFailedException();
    }
}
