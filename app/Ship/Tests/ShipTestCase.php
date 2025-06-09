<?php

declare(strict_types=1);

namespace App\Ship\Tests;

use App\Ship\Parents\Tests\TestCase as ParentTestCase;

class ShipTestCase extends ParentTestCase
{
    final protected static function normalizeSql(string $sql): string
    {
        return str_replace(['`', '"', "'"], '', $sql);
    }
}
