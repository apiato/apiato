<?php

declare(strict_types=1);

namespace App\Containers\AppSection\User\Tests\Unit\UI\API\Requests;

use App\Containers\AppSection\User\Models\User;
use App\Containers\AppSection\User\Tests\UnitTestCase;
use App\Containers\AppSection\User\UI\API\Requests\FindUserByIdRequest;
use PHPUnit\Framework\Attributes\CoversClass;

#[CoversClass(FindUserByIdRequest::class)]
final class FindUserByIdRequestTest extends UnitTestCase
{
    private FindUserByIdRequest $request;

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
        $rules = $this->request->rules();

        $this->assertSame([], $rules);
    }

    public function testAuthorizeMethodGateCall(): void
    {
        $findUserByIdRequest = FindUserByIdRequest::injectData();
        $gateMock = $this->getGateMock('show', [
            User::class,
        ]);

        $this->assertTrue($findUserByIdRequest->authorize($gateMock));
    }

    #[\Override]
    protected function setUp(): void
    {
        parent::setUp();

        $this->request = new FindUserByIdRequest();
    }
}
