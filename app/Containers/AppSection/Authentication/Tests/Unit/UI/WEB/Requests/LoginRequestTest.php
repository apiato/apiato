<?php

namespace App\Containers\AppSection\Authentication\Tests\Unit\UI\WEB\Requests;

use App\Containers\AppSection\Authentication\Tests\UnitTestCase;
use App\Containers\AppSection\Authentication\UI\WEB\Requests\LoginRequest;
use PHPUnit\Framework\Attributes\CoversClass;

#[CoversClass(LoginRequest::class)]
final class LoginRequestTest extends UnitTestCase
{
    private LoginRequest $request;

    public function testDecode(): void
    {
        $this->assertSame([], $this->request->getDecode());
    }

    public function testValidationRules(): void
    {
        $rules = $this->request->rules();

        $this->assertEquals(
            [
                'email' => ['required', 'email'],
                'password' => 'required',
                'remember' => 'boolean',
            ],
            $rules,
        );
    }

    protected function setUp(): void
    {
        parent::setUp();

        $this->request = new LoginRequest();
    }
}
