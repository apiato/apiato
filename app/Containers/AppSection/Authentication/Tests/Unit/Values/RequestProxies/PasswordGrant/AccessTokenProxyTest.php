<?php

namespace App\Containers\AppSection\Authentication\Tests\Unit\Values\RequestProxies\PasswordGrant;

use App\Containers\AppSection\Authentication\Data\Factories\ClientFactory;
use App\Containers\AppSection\Authentication\Tests\UnitTestCase;
use App\Containers\AppSection\Authentication\Values\RequestProxies\PasswordGrant\AccessTokenProxy;
use App\Containers\AppSection\Authentication\Values\UserCredential;
use PHPUnit\Framework\Attributes\CoversClass;

#[CoversClass(AccessTokenProxy::class)]
final class AccessTokenProxyTest extends UnitTestCase
{
    public function testCanCreateCookieProperly(): void
    {
        $client = ClientFactory::webClient();
        $proxy = AccessTokenProxy::create(
            UserCredential::create(
                'username',
                'password',
            ),
            $client,
            'scope1 scope2',
        );

        $this->assertSame([
            'grant_type' => 'password',
            'username' => 'username',
            'password' => 'password',
            'client_id' => $client->id(),
            'client_secret' => $client->plainSecret(),
            'scope' => 'scope1 scope2',
        ], $proxy->toArray());
    }
}
