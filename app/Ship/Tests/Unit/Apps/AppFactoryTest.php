<?php

namespace App\Ship\Tests\Unit\Apps;

use App\Ship\Apps\AppFactory;
use App\Ship\Apps\Web;
use App\Ship\Tests\ShipTestCase;
use PHPUnit\Framework\Attributes\CoversClass;

#[CoversClass(AppFactory::class)]
final class AppFactoryTest extends ShipTestCase
{
    public function testCanReturnCurrentApp(): void
    {
        request()->headers->set('App-Identifier', 'web');

        $result = AppFactory::current();

        $this->assertInstanceOf(Web::class, $result);
    }
}
