<?php

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

        $this->assertInstanceOf(WebClient::class, $sut);
        $this->assertEquals($sut->id(), $client->id());
        $this->assertEquals($sut->plainSecret(), $client->plainSecret());
        $this->assertTrue($sut->instance()->is($client->instance()));
        $this->assertIsString($sut->id());
        $this->assertIsString($sut->plainSecret());
        $this->assertNotEmpty($sut->plainSecret());
        $this->assertEquals($sut->id(), $sut->instance()->getKey());
        $this->assertNull($sut->instance()->plainSecret);
        $this->assertEquals($sut->instance()->redirect_uris, []);
        $this->assertEquals($sut->instance()->grant_types, ['password', 'refresh_token']);
        $this->assertEquals($sut->instance()->revoked, false);
        $this->assertEquals($sut->instance()->provider, 'users');
        $this->assertEquals($sut->instance()->owner_id, null);
        $this->assertEquals($sut->instance()->owner_type, null);
        $this->assertNotEmpty($sut->instance()->name);
    }
}
