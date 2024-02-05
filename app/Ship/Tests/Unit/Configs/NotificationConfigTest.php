<?php

namespace App\Ship\Tests\Unit\Configs;

use App\Ship\Tests\TestCase;
use PHPUnit\Framework\Attributes\CoversNothing;
use PHPUnit\Framework\Attributes\Group;

#[Group('ship')]
#[CoversNothing]
final class NotificationConfigTest extends TestCase
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
