<?php

namespace App\Containers\AppSection\Authentication\Tests\Unit\UI\WEB\Requests;

use App\Containers\AppSection\Authentication\Classes\LoginFieldProcessor;
use App\Containers\AppSection\Authentication\Tests\UnitTestCase;
use App\Containers\AppSection\Authentication\UI\WEB\Requests\LoginRequest;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\Group;

#[Group('authentication')]
#[CoversClass(LoginRequest::class)]
final class LoginRequestTest extends UnitTestCase
{
    private LoginRequest $request;

    public function testAccess(): void
    {
        $this->assertSame([
            'permissions' => null,
            'roles' => null,
        ], $this->request->getAccessArray());
    }

    public function testDecode(): void
    {
        $this->assertSame([], $this->request->getDecodeArray());
    }

    public function testUrlParametersArray(): void
    {
        $this->assertSame([], $this->request->getUrlParametersArray());
    }

    public function testValidationRules(): void
    {
        $rules = $this->request->rules();

        $this->assertSame(
            LoginFieldProcessor::mergeValidationRules([
                'password' => 'required',
                'remember' => 'boolean',
            ]),
            $rules,
        );
    }

    public function testAuthorizeMethodGateCall(): void
    {
        $request = LoginRequest::injectData([], $this->getTestingUserWithoutAccess());

        $this->assertTrue($request->authorize());
    }

    protected function setUp(): void
    {
        parent::setUp();

        $this->request = new LoginRequest();
    }
}
