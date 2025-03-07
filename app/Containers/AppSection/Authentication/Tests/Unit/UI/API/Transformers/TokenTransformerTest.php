<?php

namespace App\Containers\AppSection\Authentication\Tests\Unit\UI\API\Transformers;

use App\Containers\AppSection\Authentication\Data\DTOs\PasswordAccessTokenResponse;
use App\Containers\AppSection\Authentication\Tests\UnitTestCase;
use App\Containers\AppSection\Authentication\UI\API\Transformers\AccessTokenTransformer;
use PHPUnit\Framework\Attributes\CoversClass;

#[CoversClass(AccessTokenTransformer::class)]
final class TokenTransformerTest extends UnitTestCase
{
    private AccessTokenTransformer $transformer;

    public function testCanTransformSingleObject(): void
    {
        $token = new PasswordAccessTokenResponse('test', 100, 'asdc1234', '1234asdc');
        $expected = [
            'type' => $token->getResourceKey(),
            'token_type' => $token->tokenType,
            'access_token' => $token->accessToken,
            'refresh_token' => $token->refreshToken,
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
        $this->transformer = new AccessTokenTransformer();
    }
}
