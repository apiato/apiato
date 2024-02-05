<?php

namespace App\Ship\Tests\Unit;

use App\Ship\Tests\ShipTestCase;
use PHPUnit\Framework\Attributes\CoversNothing;
use PHPUnit\Framework\Attributes\Group;

#[Group('ship')]
#[CoversNothing]
final class GenerateDocumentationTest extends ShipTestCase
{
    public function testDocumentationCreation(): void
    {
        $this->markTestSkipped('Dependency not installed yet.');
        $this->artisan('apiato:apidoc')
            ->assertSuccessful();
    }
}
