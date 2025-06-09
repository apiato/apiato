<?php

declare(strict_types=1);

namespace App\Ship\Tests\Unit;

use App\Ship\Tests\ShipTestCase;
use PHPUnit\Framework\Attributes\CoversNothing;

#[CoversNothing]
final class GenerateDocumentationTest extends ShipTestCase
{
    public function testDocumentationCreation(): void
    {
        self::markTestSkipped('The apiato:apidoc command is not available in this installation');

        $this->artisan('apiato:apidoc')
            ->assertSuccessful();
    }
}
