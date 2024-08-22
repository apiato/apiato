<?php

namespace App\Ship\Tests\Unit\Configs;

use Apiato\Core\Services\Response;
use App\Ship\Tests\ShipTestCase;
use League\Fractal\Serializer\DataArraySerializer;
use PHPUnit\Framework\Attributes\CoversNothing;
use PHPUnit\Framework\Attributes\Group;

#[Group('ship')]
#[CoversNothing]
final class FractalConfigTest extends ShipTestCase
{
    public function testConfigHasCorrectValues(): void
    {
        $config = config('fractal');
        $expected = [
            'default_serializer' => DataArraySerializer::class,
            'default_paginator' => '',
            'base_url' => null,
            'fractal_class' => Response::class,
            'auto_includes' => [
                'enabled' => true,
                'request_key' => 'include',
            ],
            'auto_excludes' => [
                'enabled' => true,
                'request_key' => 'exclude',
            ],
        ];

        $this->assertSame($expected, $config);
    }
}
