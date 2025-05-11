<?php

namespace App\Containers\AppSection\Authentication\Tests\Unit\Data\Factories;

use App\Containers\AppSection\Authentication\Data\Factories\ClientFactory;
use App\Containers\AppSection\Authentication\Tests\UnitTestCase;
use App\Containers\AppSection\Authentication\Values\Clients\WebClient;
use PHPUnit\Framework\Attributes\CoversClass;

#[CoversClass(ClientFactory::class)]
final class ClientFactoryTest extends UnitTestCase
{
    public function testCanCreateWebClient(): void
    {
        $client = ClientFactory::webClient();

        $this->assertInstanceOf(WebClient::class, $client);
    }

    public function testCanCreateWebClientWithCustomAttributes(): void
    {
        $client = ClientFactory::webClient([
            'name' => 'Custom Client Name',
            'owner_id' => 1,
            'owner_type' => 'custom_owner_type',
            'redirect_uris' => ['https://example.com/callback'],
            'grant_types' => ['authorization_code', 'refresh_token'],
            'revoked' => true,
            'provider' => 'custom_provider',
        ]);

        $this->assertEquals($client->instance()->name, 'Custom Client Name');
        $this->assertEquals($client->instance()->owner_id, 1);
        $this->assertEquals($client->instance()->owner_type, 'custom_owner_type');
        $this->assertEquals($client->instance()->redirect_uris, ['https://example.com/callback']);
        $this->assertEquals($client->instance()->grant_types, ['authorization_code', 'refresh_token']);
        $this->assertEquals($client->instance()->revoked, true);
        $this->assertEquals($client->instance()->provider, 'custom_provider');
    }
}
