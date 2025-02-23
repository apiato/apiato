<?php

namespace App\Containers\AppSection\Authentication\Tests\Unit\UI\API\Requests\PasswordReset;

use App\Containers\AppSection\Authentication\Tests\UnitTestCase;
use App\Containers\AppSection\Authentication\UI\API\Requests\PasswordReset\ForgotPasswordRequest;
use PHPUnit\Framework\Attributes\CoversClass;

#[CoversClass(ForgotPasswordRequest::class)]
final class ForgotPasswordRequestTest extends UnitTestCase
{
    private ForgotPasswordRequest $request;

    public function testDecode(): void
    {
        $this->assertSame([], $this->request->getDecode());
    }

    public function testValidationRules(): void
    {
        $this->assertEquals([
            'email' => 'required|email',
        ], $this->request->rules());
    }

    protected function setUp(): void
    {
        parent::setUp();

        $this->request = new ForgotPasswordRequest();
    }
}
