<?php

namespace App\Containers\AppSection\Authentication\Tests\Unit\Data\DTOs;

use App\Containers\AppSection\Authentication\Data\DTOs\PasswordToken;
use App\Containers\AppSection\Authentication\Tests\UnitTestCase;
use App\Containers\AppSection\Authentication\Values\RefreshToken;
use PHPUnit\Framework\Attributes\CoversClass;

#[CoversClass(PasswordToken::class)]
final class PasswordTokenTest extends UnitTestCase
{
    public function testCanBeInstantiated(): void
    {
        $expiredIn = fake()->numberBetween();
        $accessToken = fake()->sha256();
        $refreshToken = fake()->sha256();
        $value = new PasswordToken(
            'Bearer',
            $expiredIn,
            $accessToken,
            RefreshToken::create($refreshToken),
        );

        $this->assertSame('Bearer', $value->tokenType);
        $this->assertSame($expiredIn, $value->expiresIn);
        $this->assertSame($accessToken, $value->accessToken);
        $this->assertSame($refreshToken, $value->refreshToken->value());
    }
}
