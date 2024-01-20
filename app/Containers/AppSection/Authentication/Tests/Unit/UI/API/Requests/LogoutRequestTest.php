<?php

namespace App\Containers\AppSection\Authentication\Tests\Unit\UI\API\Requests;

use App\Containers\AppSection\Authentication\Tests\UnitTestCase;
use App\Containers\AppSection\Authentication\UI\API\Requests\LogoutRequest;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\Group;

#[Group('authentication')]
#[CoversClass(LogoutRequest::class)]
final class LogoutRequestTest extends UnitTestCase
{
    private LogoutRequest $request;

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
        $this->assertSame([], $this->request->rules());
    }

    public function testAuthorizeMethodGateCall(): void
    {
        $request = LogoutRequest::injectData([], $this->getTestingUserWithoutAccess());

        $this->assertTrue($request->authorize());
    }

    protected function setUp(): void
    {
        parent::setUp();

        $this->request = new LogoutRequest();
    }
}
