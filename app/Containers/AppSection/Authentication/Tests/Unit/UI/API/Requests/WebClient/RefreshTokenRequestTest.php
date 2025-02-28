<?php

namespace App\Containers\AppSection\Authentication\Tests\Unit\UI\API\Requests\WebClient;

use App\Containers\AppSection\Authentication\Tests\UnitTestCase;
use App\Containers\AppSection\Authentication\UI\API\Requests\WebClient\RefreshTokenRequest;
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
        $this->assertSame([
            'refresh_token' => 'string',
        ], $this->request->rules());
    }

    protected function setUp(): void
    {
        parent::setUp();

        $this->request = new RefreshTokenRequest();
    }
}
