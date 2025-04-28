<?php

declare(strict_types=1);

namespace App\Containers\AppSection\Authentication\Tests\Unit\UI\API\Requests;

use App\Containers\AppSection\Authentication\Tests\UnitTestCase;
use App\Containers\AppSection\Authentication\UI\API\Requests\RefreshProxyRequest;
use PHPUnit\Framework\Attributes\CoversClass;

#[CoversClass(RefreshProxyRequest::class)]
final class RefreshProxyRequestTest extends UnitTestCase
{
    private RefreshProxyRequest $request;

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
        $this->assertSame([
            'refresh_token' => 'string',
        ], $this->request->rules());
    }

    public function testAuthorizeMethodGateCall(): void
    {
        $refreshProxyRequest = RefreshProxyRequest::injectData([], $this->getTestingUserWithoutAccess());

        $this->assertTrue($refreshProxyRequest->authorize());
    }

    #[\Override]
    protected function setUp(): void
    {
        parent::setUp();

        $this->request = new RefreshProxyRequest();
    }
}
