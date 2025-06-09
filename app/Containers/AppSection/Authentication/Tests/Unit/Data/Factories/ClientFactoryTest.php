<?php

declare(strict_types=1);

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

        self::assertInstanceOf(WebClient::class, $client);
    }

    public function testCanCreateWebClientWithCustomAttributes(): void
    {
        $client = ClientFactory::webClient([
            'name'          => 'Custom Client Name',
            'owner_id'      => 1,
            'owner_type'    => 'custom_owner_type',
            'redirect_uris' => ['https://example.com/callback'],
            'grant_types'   => ['authorization_code', 'refresh_token'],
            'revoked'       => true,
            'provider'      => 'custom_provider',
        ]);

        self::assertEquals('Custom Client Name', $client->instance()->name);
        self::assertEquals(1, $client->instance()->owner_id);
        self::assertEquals('custom_owner_type', $client->instance()->owner_type);
        self::assertEquals($client->instance()->redirect_uris, ['https://example.com/callback']);
        self::assertEquals($client->instance()->grant_types, ['authorization_code', 'refresh_token']);
        self::assertEquals(true, $client->instance()->revoked);
        self::assertEquals('custom_provider', $client->instance()->provider);
    }
}
