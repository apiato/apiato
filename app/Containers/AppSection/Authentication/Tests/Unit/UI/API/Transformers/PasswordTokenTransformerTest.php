<?php

declare(strict_types=1);

namespace App\Containers\AppSection\Authentication\Tests\Unit\UI\API\Transformers;

use App\Containers\AppSection\Authentication\Data\DTOs\PasswordToken;
use App\Containers\AppSection\Authentication\Tests\UnitTestCase;
use App\Containers\AppSection\Authentication\UI\API\Transformers\PasswordTokenTransformer;
use App\Containers\AppSection\Authentication\Values\RefreshToken;
use PHPUnit\Framework\Attributes\CoversClass;

#[CoversClass(PasswordTokenTransformer::class)]
final class PasswordTokenTransformerTest extends UnitTestCase
{
    private PasswordTokenTransformer $transformer;

    public function testCanTransformSingleObject(): void
    {
        $passwordToken = new PasswordToken(
            'Bearer',
            100,
            'asdc1234',
            RefreshToken::create('1234asdc'),
        );
        $expected = [
            'type'          => $passwordToken->getResourceKey(),
            'token_type'    => $passwordToken->tokenType,
            'access_token'  => $passwordToken->accessToken,
            'refresh_token' => $passwordToken->refreshToken->value(),
            'expires_in'    => $passwordToken->expiresIn,
        ];

        $transformedResource = $this->transformer->transform($passwordToken);

        self::assertSame($expected, $transformedResource);
    }

    public function testAvailableIncludes(): void
    {
        self::assertSame([], $this->transformer->getAvailableIncludes());
    }

    public function testDefaultIncludes(): void
    {
        self::assertSame([], $this->transformer->getDefaultIncludes());
    }

    protected function setUp(): void
    {
        parent::setUp();

        $this->transformer = new PasswordTokenTransformer();
    }
}
