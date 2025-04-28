<?php

declare(strict_types=1);

namespace App\Ship\Tests\Unit\Configs;

use App\Ship\Tests\ShipTestCase;
use PHPUnit\Framework\Attributes\CoversNothing;

#[CoversNothing]
final class HashIdsConfigTest extends ShipTestCase
{
    public function testConfigHasCorrectValues(): void
    {
        $config = config('hashids');
        $expected = [
            'default'     => 'main',
            'connections' => [
                'main' => [
                    'salt'     => (string) env('HASH_ID_KEY', env('APP_KEY')),
                    'length'   => (int) env('HASH_ID_LENGTH', 32),
                    'alphabet' => 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890',
                ],

                'alternative' => [
                    'salt'   => 'your-salt-string',
                    'length' => (int) 'your-length-integer',
                    // 'alphabet' => 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890'
                ],
            ],
        ];

        $this->assertSame($expected, $config);
    }
}
