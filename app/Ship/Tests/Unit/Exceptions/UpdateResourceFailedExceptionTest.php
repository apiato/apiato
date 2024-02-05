<?php

namespace App\Ship\Tests\Unit\Exceptions;

use App\Ship\Exceptions\UpdateResourceFailedException;
use App\Ship\Tests\TestCase;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\Group;

#[Group('ship')]
#[CoversClass(UpdateResourceFailedException::class)]
final class UpdateResourceFailedExceptionTest extends TestCase
{
    public function testException(): void
    {
        $this->expectExceptionCode(417);
        $this->expectExceptionMessage('Failed to update Resource.');

        throw new UpdateResourceFailedException();
    }
}
