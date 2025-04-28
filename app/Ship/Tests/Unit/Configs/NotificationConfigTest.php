<?php

declare(strict_types=1);

namespace App\Ship\Tests\Unit\Configs;

use App\Ship\Tests\ShipTestCase;
use PHPUnit\Framework\Attributes\CoversNothing;

#[CoversNothing]
final class NotificationConfigTest extends ShipTestCase
{
    public function testConfigHasCorrectValues(): void
    {
        $config = config('notification');
        $expected = [
            'channels' => [
                'database',
                // 'mail',
            ],
        ];

        $this->assertSame($expected, $config);
    }
}
