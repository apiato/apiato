<?php

namespace App\Containers\AppSection\Authentication\Tests\Unit\Configs;

use App\Ship\Tests\ShipTestCase;
use PHPUnit\Framework\Attributes\CoversNothing;

#[CoversNothing]
final class PassportTest extends ShipTestCase
{
    public function testConfigHasCorrectValues(): void
    {
        $config = config('passport');
        $expected = [
            'guard' => 'api',
            'private_key' => env('PASSPORT_PRIVATE_KEY'),
            'public_key' => env('PASSPORT_PUBLIC_KEY'),
            'connection' => env('PASSPORT_CONNECTION'),
        ];

        $this->assertSame($expected, $config);
    }
}
