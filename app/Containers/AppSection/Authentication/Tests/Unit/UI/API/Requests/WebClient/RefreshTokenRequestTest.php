<?php

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
        $request = new RefreshTokenRequest();

        $this->assertSame([], $request->getDecode());
    }

    public function testValidationRules(): void
    {
        $request = new RefreshTokenRequest();
        $cookieName = RefreshToken::cookieName();

        $this->assertEquals([
            'refresh_token' => [
                'string',
                Rule::requiredIf(
                    static fn () => !$request->hasCookie(
                        $cookieName,
                    ),
                ),
            ],
            $cookieName => [
                'string',
                Rule::requiredIf(
                    static fn () => !$request->has('refresh_token'),
                ),
            ],
        ], $request->rules());
    }
}
