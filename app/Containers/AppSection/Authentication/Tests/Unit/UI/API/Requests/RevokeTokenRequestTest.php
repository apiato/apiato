<?php

declare(strict_types=1);

namespace App\Containers\AppSection\Authentication\Tests\Unit\UI\API\Requests;

use App\Containers\AppSection\Authentication\Tests\UnitTestCase;
use App\Containers\AppSection\Authentication\UI\API\Requests\RevokeTokenRequest;
use PHPUnit\Framework\Attributes\CoversClass;

#[CoversClass(RevokeTokenRequest::class)]
final class RevokeTokenRequestTest extends UnitTestCase
{
    private RevokeTokenRequest $request;

    public function testDecode(): void
    {
        self::assertSame([], $this->request->getDecode());
    }

    public function testValidationRules(): void
    {
        self::assertSame([], $this->request->rules());
    }

    protected function setUp(): void
    {
        parent::setUp();

        $this->request = new RevokeTokenRequest();
    }
}
