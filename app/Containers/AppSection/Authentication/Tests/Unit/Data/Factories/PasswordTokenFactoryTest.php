<?php

namespace App\Containers\AppSection\Authentication\Tests\Unit\Data\Factories;

use App\Containers\AppSection\Authentication\Data\DTOs\PasswordToken;
use App\Containers\AppSection\Authentication\Data\Factories\ClientFactory;
use App\Containers\AppSection\Authentication\Data\Factories\PasswordTokenFactory;
use App\Containers\AppSection\Authentication\Tests\UnitTestCase;
use App\Containers\AppSection\Authentication\Values\RequestProxies\PasswordGrant\AccessTokenProxy;
use App\Containers\AppSection\Authentication\Values\UserCredential;
use App\Containers\AppSection\User\Models\User;
use PHPUnit\Framework\Attributes\CoversClass;

#[CoversClass(PasswordTokenFactory::class)]
final class PasswordTokenFactoryTest extends UnitTestCase
{
    private User|null $user = null;
    private PasswordTokenFactory|null $factory = null;
    private AccessTokenProxy|null $proxy = null;

    public function testCanCreateToken(): void
    {
        $token = $this->factory->make($this->proxy);

        $this->assertExpectedResponse($token);
        $this->assertNull($this->user->token());
    }

    private function assertExpectedResponse(PasswordToken $token): void
    {
        $this->assertSame('Bearer', $token->tokenType);
        $this->assertGreaterThan(0, $token->expiresIn);
        $this->assertNotEmpty($token->accessToken);
        $this->assertNotEmpty($token->refreshToken);
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
        $this->factory = app(PasswordTokenFactory::class);
        $this->proxy = AccessTokenProxy::create(
            UserCredential::create(
                $this->user->email,
                'password',
            ),
            ClientFactory::webClient(),
        );
    }
}
