<?php

namespace App\Containers\AppSection\Authentication\Tests\Unit\UI\API\Requests;

use App\Containers\AppSection\Authentication\Tests\UnitTestCase;
use App\Containers\AppSection\Authentication\UI\API\Requests\SendVerificationEmailToIdRequest;
use Illuminate\Contracts\Auth\Access\Gate;
use Illuminate\Validation\Rule;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\Group;

#[Group('authentication')]
#[CoversClass(SendVerificationEmailToIdRequest::class)]
final class SendVerificationEmailToIdRequestTest extends UnitTestCase
{
    private SendVerificationEmailToIdRequest $request;

    public function testAccess(): void
    {
        $this->assertSame([
            'permissions' => null,
            'roles' => null,
        ], $this->request->getAccessArray());
    }

    public function testDecode(): void
    {
        $this->assertSame([
            'user_id',
        ], $this->request->getDecodeArray());
    }

    public function testUrlParametersArray(): void
    {
        $this->assertSame([
            'user_id',
        ], $this->request->getUrlParametersArray());
    }

    public function testValidationRules(): void
    {
        $this->assertEquals([
            'verification_url' => [
                'required',
                Rule::in(config('appSection-authentication.allowed-verify-email-urls')),
            ],
        ], $this->request->rules());
    }

    public function testAuthorizeMethodGateCall(): void
    {
        $request = SendVerificationEmailToIdRequest::injectData([], $this->getTestingUserWithoutAccess());
        $gateMock = $this->mock(Gate::class);

        $this->assertTrue($request->authorize($gateMock));
    }

    protected function setUp(): void
    {
        parent::setUp();

        $this->request = new SendVerificationEmailToIdRequest();
    }
}
