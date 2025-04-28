<?php

declare(strict_types=1);

namespace App\Containers\AppSection\Authentication\Tests\Unit\UI\API\Requests;

use App\Containers\AppSection\Authentication\Tests\UnitTestCase;
use App\Containers\AppSection\Authentication\UI\API\Requests\VerifyEmailRequest;
use PHPUnit\Framework\Attributes\CoversClass;

#[CoversClass(VerifyEmailRequest::class)]
final class VerifyEmailRequestTest extends UnitTestCase
{
    private VerifyEmailRequest $request;

    public function testAccess(): void
    {
        $this->assertSame([
            'permissions' => null,
            'roles'       => null,
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
        $this->assertSame([], $this->request->rules());
    }

    public function testAuthorizeMethodGateCall(): void
    {
        $verifyEmailRequest = VerifyEmailRequest::injectData([], $this->getTestingUserWithoutAccess());

        $this->assertTrue($verifyEmailRequest->authorize());
    }

    #[\Override]
    protected function setUp(): void
    {
        parent::setUp();

        $this->request = new VerifyEmailRequest();
    }
}
