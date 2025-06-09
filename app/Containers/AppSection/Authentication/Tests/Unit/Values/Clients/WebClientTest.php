<?php

declare(strict_types=1);

namespace App\Containers\AppSection\Authentication\Tests\Unit\Values\Clients;

use App\Containers\AppSection\Authentication\Data\Factories\ClientFactory;
use App\Containers\AppSection\Authentication\Tests\UnitTestCase;
use App\Containers\AppSection\Authentication\Values\Clients\WebClient;
use PHPUnit\Framework\Attributes\CoversClass;

#[CoversClass(WebClient::class)]
final class WebClientTest extends UnitTestCase
{
    public function testCanBeInstantiated(): void
    {
        $client = ClientFactory::webClient();
        $sut = WebClient::create();

        self::assertInstanceOf(WebClient::class, $sut);
        self::assertEquals($sut->id(), $client->id());
        self::assertSame($sut->plainSecret(), $client->plainSecret());
        self::assertTrue($sut->instance()->is($client->instance()));
        self::assertIsString($sut->id());
        self::assertIsString($sut->plainSecret());
        self::assertNotEmpty($sut->plainSecret());
        self::assertEquals($sut->id(), $sut->instance()->getKey());
        self::assertNull($sut->instance()->plainSecret);
        self::assertEquals($sut->instance()->redirect_uris, []);
        self::assertEquals($sut->instance()->grant_types, ['password', 'refresh_token']);
        self::assertEquals(false, $sut->instance()->revoked);
        self::assertEquals('users', $sut->instance()->provider);
        self::assertEquals(null, $sut->instance()->owner_id);
        self::assertEquals(null, $sut->instance()->owner_type);
        self::assertNotEmpty($sut->instance()->name);
    }
}
