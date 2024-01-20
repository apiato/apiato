<?php

namespace App\Containers\AppSection\Authentication\Tests\Unit\UI\API\Transformers;

use App\Containers\AppSection\Authentication\Tests\UnitTestCase;
use App\Containers\AppSection\Authentication\UI\API\Transformers\TokenTransformer;
use App\Containers\AppSection\Authentication\Values\Token;
use Illuminate\Support\Facades\Config;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\Group;

#[Group('authentication')]
#[CoversClass(TokenTransformer::class)]
final class TokenTransformerTest extends UnitTestCase
{
    public function testTransformSingleToken(): void
    {
        $token = new Token('test', 100, 'asdc1234', '1234asdc');
        $transformer = new TokenTransformer();
        $expectedTransformedArray = [
            'object' => 'Token',
            'token_type' => $token->tokenType,
            'access_token' => $token->accessToken,
            'refresh_token' => $token->refreshToken,
            'expires_in' => $token->expiresIn,
        ];

        $resource = $transformer->transform($token);

        $this->assertIsArray($resource);
        foreach ($expectedTransformedArray as $key => $value) {
            $this->assertSame($value, $resource[$key]);
        }
    }
}
