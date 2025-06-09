<?php

declare(strict_types=1);

namespace App\Containers\AppSection\Authentication\Tests\Unit\Data\Factories;

use App\Containers\AppSection\Authentication\Data\DTOs\PasswordToken;
use App\Containers\AppSection\Authentication\Data\Factories\ClientFactory;
use App\Containers\AppSection\Authentication\Data\Factories\PasswordTokenFactory;
use App\Containers\AppSection\Authentication\Tests\UnitTestCase;
use App\Containers\AppSection\Authentication\Values\RequestProxies\PasswordGrant\AccessTokenProxy;
use App\Containers\AppSection\Authentication\Values\UserCredential;
use App\Containers\AppSection\User\Models\User;
use Laravel\Passport\Contracts\ScopeAuthorizable;
use PHPUnit\Framework\Attributes\CoversClass;

#[CoversClass(PasswordTokenFactory::class)]
final class PasswordTokenFactoryTest extends UnitTestCase
{
    private null|User $user = null;

    private null|PasswordTokenFactory $factory = null;

    private null|AccessTokenProxy $proxy = null;

    public function testCanCreateToken(): void
    {
        $token = $this->factory->make($this->proxy);

        $this->assertExpectedResponse($token);
        self::assertNotInstanceOf(ScopeAuthorizable::class, $this->user->token());
    }

    public function testCanCreateTokenForUser(): void
    {
        $token = $this->factory->for($this->user)->make($this->proxy);

        $this->assertExpectedResponse($token);
    }

    protected function setUp(): void
    {
        parent::setUp();

        $this->user = User::factory()->createOne([
            'password' => 'password',
        ]);
        /** @phpstan-ignore-next-line */
        $this->factory = app(PasswordTokenFactory::class);
        $this->proxy = AccessTokenProxy::create(
            UserCredential::create(
                $this->user->email,
                'password',
            ),
            ClientFactory::webClient(),
        );
    }

    private function assertExpectedResponse(PasswordToken $token): void
    {
        self::assertSame('Bearer', $token->tokenType);
        $this->assertGreaterThan(0, $token->expiresIn);
        self::assertNotEmpty($token->accessToken);
        self::assertNotEmpty($token->refreshToken);
    }
}
