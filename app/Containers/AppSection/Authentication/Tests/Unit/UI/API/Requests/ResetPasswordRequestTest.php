<?php

namespace App\Containers\AppSection\Authentication\Tests\Unit\UI\API\Requests;

use App\Containers\AppSection\Authentication\Tests\UnitTestCase;
use App\Containers\AppSection\Authentication\UI\API\Requests\ResetPasswordRequest;
use Illuminate\Validation\Rules\Password;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\Group;

#[Group('authentication')]
#[CoversClass(ResetPasswordRequest::class)]
final class ResetPasswordRequestTest extends UnitTestCase
{
    private ResetPasswordRequest $request;

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
        $this->assertEquals([
            'token' => 'required',
            'email' => 'required|email',
            'password' => [
                'required',
                Password::default(),
            ],
        ], $this->request->rules());
    }

    public function testAuthorizeMethodGateCall(): void
    {
        $request = ResetPasswordRequest::injectData([], $this->getTestingUserWithoutAccess());

        $this->assertTrue($request->authorize());
    }

    protected function setUp(): void
    {
        parent::setUp();

        $this->request = new ResetPasswordRequest();
    }
}
