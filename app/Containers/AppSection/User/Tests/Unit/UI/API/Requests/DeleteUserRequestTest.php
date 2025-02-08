<?php

namespace App\Containers\AppSection\User\Tests\Unit\UI\API\Requests;

use App\Containers\AppSection\User\Models\User;
use App\Containers\AppSection\User\Tests\UnitTestCase;
use App\Containers\AppSection\User\UI\API\Requests\DeleteUserRequest;
use PHPUnit\Framework\Attributes\CoversClass;

#[CoversClass(DeleteUserRequest::class)]
final class DeleteUserRequestTest extends UnitTestCase
{
    private DeleteUserRequest $request;

    public function testDecode(): void
    {
        $this->assertSame([
            'user_id',
        ], $this->request->getDecodeArray());
    }

    public function testValidationRules(): void
    {
        $rules = $this->request->rules();

        $this->assertSame([], $rules);
    }

    public function testAuthorizeMethodGateCall(): void
    {
        $request = DeleteUserRequest::injectData();
        $gateMock = $this->getGateMock('delete', [
            User::class,
        ]);

        $this->assertTrue($request->authorize($gateMock));
    }

    protected function setUp(): void
    {
        parent::setUp();

        $this->request = new DeleteUserRequest();
    }
}
