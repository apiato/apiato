<?php

namespace App\Containers\AppSection\Authentication\Tests\Unit\Values\RequestProxies\PasswordGrant;

use App\Containers\AppSection\Authentication\Data\Factories\ClientFactory;
use App\Containers\AppSection\Authentication\Tests\UnitTestCase;
use App\Containers\AppSection\Authentication\Values\RefreshToken;
use App\Containers\AppSection\Authentication\Values\RequestProxies\PasswordGrant\RefreshTokenProxy;
use PHPUnit\Framework\Attributes\CoversClass;

#[CoversClass(RefreshTokenProxy::class)]
final class RefreshTokenProxyTest extends UnitTestCase
{
    public function testCanCreateCookieProperly(): void
    {
        $client = ClientFactory::webClient();
        $proxy = RefreshTokenProxy::create(
            RefreshToken::create('refresh-token'),
            $client,
            'scope1 scope2',
        );

        $this->assertSame([
            'grant_type' => 'refresh_token',
            'refresh_token' => 'refresh-token',
            'client_id' => $client->id(),
            'client_secret' => $client->plainSecret(),
            'scope' => 'scope1 scope2',
        ], $proxy->toArray());
    }
}
