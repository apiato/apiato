<?php

namespace App\Ship\Tests\Unit\Exceptions;

use App\Ship\Exceptions\UnsupportedFractalSerializerException;
use App\Ship\Tests\ShipTestCase;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\Group;

#[Group('ship')]
#[CoversClass(UnsupportedFractalSerializerException::class)]
final class UnSupportedFractalSerializerExceptionTest extends ShipTestCase
{
    public function testException(): void
    {
        $this->expectExceptionCode(500);
        $this->expectExceptionMessage('Unsupported Fractal Serializer!');

        throw new UnsupportedFractalSerializerException();
    }
}
