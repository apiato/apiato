<?php

namespace App\Containers\AppSection\Authentication\Tests\Unit\UI\API\Requests\PasswordReset;

use App\Containers\AppSection\Authentication\Tests\UnitTestCase;
use App\Containers\AppSection\Authentication\UI\API\Requests\PasswordReset\ResetPasswordRequest;
use Illuminate\Validation\Rules\Password;
use PHPUnit\Framework\Attributes\CoversClass;

#[CoversClass(ResetPasswordRequest::class)]
final class ResetPasswordRequestTest extends UnitTestCase
{
    private ResetPasswordRequest $request;

    public function testDecode(): void
    {
        $this->assertSame([], $this->request->getDecode());
    }

    public function testValidationRules(): void
    {
        $this->assertEquals([
            'token' => 'required',
            'email' => 'required|email',
            'password' => [...Password::required(), 'confirmed'],
        ], $this->request->rules());
    }

    protected function setUp(): void
    {
        parent::setUp();

        $this->request = new ResetPasswordRequest();
    }
}
