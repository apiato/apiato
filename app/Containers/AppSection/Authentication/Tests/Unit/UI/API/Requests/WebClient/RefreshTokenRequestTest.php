<?php

declare(strict_types=1);

namespace App\Containers\AppSection\Authentication\Tests\Unit\UI\API\Requests\WebClient;

use App\Containers\AppSection\Authentication\Tests\UnitTestCase;
use App\Containers\AppSection\Authentication\UI\API\Requests\WebClient\RefreshTokenRequest;
use App\Containers\AppSection\Authentication\Values\RefreshToken;
use Illuminate\Validation\Rule;
use PHPUnit\Framework\Attributes\CoversClass;

#[CoversClass(RefreshTokenRequest::class)]
final class RefreshTokenRequestTest extends UnitTestCase
{
    public function testDecode(): void
    {
        $refreshTokenRequest = new RefreshTokenRequest();

        self::assertSame([], $refreshTokenRequest->getDecode());
    }

    public function testValidationRules(): void
    {
        $refreshTokenRequest = new RefreshTokenRequest();
        $cookieName = RefreshToken::cookieName();

        self::assertEquals([
            'refresh_token' => [
                'string',
                Rule::requiredIf(
                    static fn (): bool => !$refreshTokenRequest->hasCookie(
                        $cookieName,
                    ),
                ),
            ],
            $cookieName => [
                'string',
                Rule::requiredIf(
                    static fn (): bool => !$refreshTokenRequest->has('refresh_token'),
                ),
            ],
        ], $refreshTokenRequest->rules());
    }
}
