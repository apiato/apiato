<?php

namespace App\Containers\AppSection\Authentication\Tests\Unit\UI\API\Requests\WebClient;

use App\Containers\AppSection\Authentication\Data\Dto\Token;
use App\Containers\AppSection\Authentication\Tests\UnitTestCase;
use App\Containers\AppSection\Authentication\UI\API\Requests\WebClient\RefreshTokenRequest;
use Illuminate\Validation\Rule;
use PHPUnit\Framework\Attributes\CoversClass;

#[CoversClass(RefreshTokenRequest::class)]
final class RefreshTokenRequestTest extends UnitTestCase
{
    private RefreshTokenRequest $request;

    public function testDecode(): void
    {
        $this->assertSame([], $this->request->getDecode());
    }

    public function testValidationRules(): void
    {
        $this->assertEquals([
            'refresh_token' => ['string', Rule::requiredIf(fn () => !$this->hasCookie(Token::refreshTokenCookieName()))],
            Token::refreshTokenCookieName() => ['string', Rule::requiredIf(fn () => !$this->has('refresh_token'))],
        ], $this->request->rules());
    }

    protected function setUp(): void
    {
        parent::setUp();

        $this->request = new RefreshTokenRequest();
    }
}
