<?php

declare(strict_types=1);

namespace App\Ship\Parents\Tests;

use Apiato\Core\Testing\TestCase as AbstractTestCase;
use Illuminate\Foundation\Testing\LazilyRefreshDatabase;

/**
 * @SuppressWarnings(PHPMD.NumberOfChildren)
 */
abstract class TestCase extends AbstractTestCase
{
    use LazilyRefreshDatabase;
}
