<?php

declare(strict_types=1);

namespace App\Ship\Tests\Unit\Exceptions;

use App\Ship\Exceptions\NotImplementedException;
use App\Ship\Tests\ShipTestCase;
use PHPUnit\Framework\Attributes\CoversClass;

#[CoversClass(NotImplementedException::class)]
final class NotImplementedExceptionTest extends ShipTestCase
{
    public function testException(): void
    {
        $this->expectExceptionCode(501);
        $this->expectExceptionMessage('This method is not yet implemented.');

        throw new NotImplementedException();
    }
}
