<?php

namespace App\Ship\Tests\Unit\Configs;

use Apiato\Http\Response;
use App\Ship\Tests\ShipTestCase;
use League\Fractal\Pagination\IlluminatePaginatorAdapter;
use League\Fractal\Serializer\DataArraySerializer;
use PHPUnit\Framework\Attributes\CoversNothing;

#[CoversNothing]
final class FractalTest extends ShipTestCase
{
    public function testConfigHasCorrectValues(): void
    {
        $config = config('fractal');
        $expected = [
            'default_serializer' => DataArraySerializer::class,
            'default_paginator' => IlluminatePaginatorAdapter::class,
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
            'auto_fieldsets' => [
                'enabled' => true,
                'request_key' => 'fields',
            ],
        ];

        $this->assertEqualsCanonicalizing($expected, $config);
    }
}
