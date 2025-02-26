<?php

namespace App\Ship\Parents\Tests;

use Apiato\Abstract\Tests\TestCase as AbstractTestCase;
use Illuminate\Foundation\Testing\LazilyRefreshDatabase;

abstract class TestCase extends AbstractTestCase
{
    use LazilyRefreshDatabase;
}
