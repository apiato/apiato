<?php

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
        $token = new PasswordToken(
            'Bearer',
            100,
            'asdc1234',
            RefreshToken::create('1234asdc'),
        );
        $expected = [
            'type' => $token->getResourceKey(),
            'token_type' => $token->tokenType,
            'access_token' => $token->accessToken,
            'refresh_token' => $token->refreshToken->value(),
            'expires_in' => $token->expiresIn,
        ];

        $transformedResource = $this->transformer->transform($token);

        $this->assertEquals($expected, $transformedResource);
    }

    public function testAvailableIncludes(): void
    {
        $this->assertSame([], $this->transformer->getAvailableIncludes());
    }

    public function testDefaultIncludes(): void
    {
        $this->assertSame([], $this->transformer->getDefaultIncludes());
    }

    protected function setUp(): void
    {
        parent::setUp();
        $this->transformer = new PasswordTokenTransformer();
    }
}
