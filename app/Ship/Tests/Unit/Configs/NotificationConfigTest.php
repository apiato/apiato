<?php

namespace App\Ship\Tests\Unit\Configs;

use App\Ship\Tests\ShipTestCase;
use PHPUnit\Framework\Attributes\CoversNothing;
use PHPUnit\Framework\Attributes\Group;

#[Group('ship')]
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
