<?php

namespace App\Containers\AppSection\Authorization\Tests\Unit\UI\API\Requests;

use App\Containers\AppSection\Authorization\Tests\UnitTestCase;
use App\Containers\AppSection\Authorization\UI\API\Requests\RevokeRolesFromUserRequest;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\Group;

#[Group('authorization')]
#[CoversClass(RevokeRolesFromUserRequest::class)]
class RevokeRolesFromUserRequestTest extends UnitTestCase
{
    private RevokeRolesFromUserRequest $request;

    public function testAccess(): void
    {
        $this->assertSame([
            'permissions' => 'manage-admins-access',
            'roles' => null,
        ], $this->request->getAccessArray());
    }

    public function testDecode(): void
    {
        $this->assertSame([
            'roles_ids.*',
            'user_id',
        ], $this->request->getDecodeArray());
    }

    public function testUrlParametersArray(): void
    {
        $this->assertSame([], $this->request->getUrlParametersArray());
    }

    public function testValidationRules(): void
    {
        $rules = $this->request->rules();

        $this->assertSame([
            'roles_ids' => 'array|required',
            'roles_ids.*' => 'required|exists:roles,id',
            'user_id' => 'required|exists:users,id',
        ], $rules);
    }

    public function testAuthorizeMethodGateCall(): void
    {
        $user = $this->getTestingUser(access: ['permissions' => 'manage-admins-access']);
        $request = RevokeRolesFromUserRequest::injectData([], $user);

        $this->assertTrue($request->authorize());
    }

    protected function setUp(): void
    {
        parent::setUp();

        $this->request = new RevokeRolesFromUserRequest();
    }
}
