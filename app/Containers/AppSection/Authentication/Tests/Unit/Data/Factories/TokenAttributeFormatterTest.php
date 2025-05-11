<?php

namespace App\Containers\AppSection\Authentication\Tests\Unit\Data\Factories;

use App\Containers\AppSection\Authentication\Data\Factories\ClientFactory;
use App\Containers\AppSection\Authentication\Data\Factories\PasswordTokenFactory;
use App\Containers\AppSection\Authentication\Data\Factories\TokenAttributeFormatter;
use App\Containers\AppSection\Authentication\Tests\UnitTestCase;
use App\Containers\AppSection\Authentication\Values\RequestProxies\PasswordGrant\AccessTokenProxy;
use App\Containers\AppSection\Authentication\Values\UserCredential;
use App\Containers\AppSection\User\Models\User;
use PHPUnit\Framework\Attributes\CoversClass;

#[CoversClass(TokenAttributeFormatter::class)]
final class TokenAttributeFormatterTest extends UnitTestCase
{
    public function testCanFormatAttributes(): void
    {
        $user = User::factory()->createOne([
            'password' => 'password',
        ]);
        $token = app(PasswordTokenFactory::class)->make(
            AccessTokenProxy::create(
                UserCredential::create(
                    $user->email,
                    'password',
                ),
                ClientFactory::webClient(),
            ),
        );

        $result = app(TokenAttributeFormatter::class)->format(
            $token->accessToken,
        );

        $this->assertArrayHasKey('oauth_access_token_id', $result);
        $this->assertArrayHasKey('oauth_client_id', $result);
        $this->assertArrayHasKey('oauth_user_id', $result);
        $this->assertArrayHasKey('oauth_scopes', $result);
    }
}
