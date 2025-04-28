<?php

declare(strict_types=1);

namespace App\Ship\Tests\Unit\Exceptions;

use App\Ship\Exceptions\NotFoundException;
use App\Ship\Tests\ShipTestCase;
use PHPUnit\Framework\Attributes\CoversClass;

#[CoversClass(NotFoundException::class)]
final class NotFoundExceptionTest extends ShipTestCase
{
    public function testException(): void
    {
        $this->expectExceptionCode(404);
        $this->expectExceptionMessage('The requested resource could not be found.');

        throw new NotFoundException();
    }
}
