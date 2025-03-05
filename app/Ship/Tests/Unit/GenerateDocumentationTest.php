<?php

namespace App\Ship\Tests\Unit;

use App\Ship\Tests\ShipTestCase;
use PHPUnit\Framework\Attributes\CoversNothing;

#[CoversNothing]
final class GenerateDocumentationTest extends ShipTestCase
{
    public function testDocumentationCreation(): void
    {
        $this->artisan('apiato:apidoc')
            ->assertSuccessful();
    }
}
