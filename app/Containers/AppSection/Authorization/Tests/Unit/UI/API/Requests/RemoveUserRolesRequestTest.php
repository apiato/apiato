<?php

namespace App\Containers\AppSection\Authorization\Tests\Unit\UI\API\Requests;

use App\Containers\AppSection\Authorization\Tests\UnitTestCase;
use App\Containers\AppSection\Authorization\UI\API\Requests\RemoveUserRolesRequest;
use PHPUnit\Framework\Attributes\CoversClass;

#[CoversClass(RemoveUserRolesRequest::class)]
final class RemoveUserRolesRequestTest extends UnitTestCase
{
    private RemoveUserRolesRequest $request;

    public function testDecode(): void
    {
        $this->assertSame([
            'user_id',
            'role_ids.*',
        ], $this->request->getDecodeArray());
    }

    public function testValidationRules(): void
    {
        $rules = $this->request->rules();

        $this->assertSame([
            'user_id' => 'exists:users,id',
            'role_ids' => 'array|required',
            'role_ids.*' => 'required|exists:roles,id',
        ], $rules);
    }

    public function testAuthorizeMethodGateCall(): void
    {
        $user = $this->getTestingUserWithoutAccess();
        $request = RemoveUserRolesRequest::injectData([], $user);

        $this->assertFalse($request->authorize());
    }

    protected function setUp(): void
    {
        parent::setUp();

        $this->request = new RemoveUserRolesRequest();
    }
}
