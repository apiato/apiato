<?php

declare(strict_types=1);

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
        /** @var PasswordTokenFactory $passwordTokenFactory */
        $passwordTokenFactory = app(PasswordTokenFactory::class);
        $token = $passwordTokenFactory->make(
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

        self::assertArrayHasKey('oauth_access_token_id', $result);
        self::assertArrayHasKey('oauth_client_id', $result);
        self::assertArrayHasKey('oauth_user_id', $result);
        self::assertArrayHasKey('oauth_scopes', $result);
    }
}
