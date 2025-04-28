<?php

declare(strict_types=1);

namespace App\Containers\AppSection\Authentication\Tests\Unit\UI\API\Requests;

use App\Containers\AppSection\Authentication\Tests\UnitTestCase;
use App\Containers\AppSection\Authentication\UI\API\Requests\SendVerificationEmailRequest;
use Illuminate\Validation\Rule;
use PHPUnit\Framework\Attributes\CoversClass;

#[CoversClass(SendVerificationEmailRequest::class)]
final class SendVerificationEmailRequestTest extends UnitTestCase
{
    private SendVerificationEmailRequest $request;

    public function testAccess(): void
    {
        $this->assertSame([
            'permissions' => null,
            'roles'       => null,
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
            'verification_url' => [
                'required',
                'url',
                Rule::in(config('appSection-authentication.allowed-verify-email-urls')),
            ],
        ], $this->request->rules());
    }

    public function testAuthorizeMethodGateCall(): void
    {
        $sendVerificationEmailRequest = SendVerificationEmailRequest::injectData([], $this->getTestingUserWithoutAccess());

        $this->assertTrue($sendVerificationEmailRequest->authorize());
    }

    #[\Override]
    protected function setUp(): void
    {
        parent::setUp();

        $this->request = new SendVerificationEmailRequest();
    }
}
