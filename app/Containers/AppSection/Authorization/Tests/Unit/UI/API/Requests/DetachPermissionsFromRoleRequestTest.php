<?php

namespace App\Containers\AppSection\Authorization\Tests\Unit\UI\API\Requests;

use App\Containers\AppSection\Authorization\Tests\UnitTestCase;
use App\Containers\AppSection\Authorization\UI\API\Requests\DetachPermissionsFromRoleRequest;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\Group;

#[Group('authorization')]
#[CoversClass(DetachPermissionsFromRoleRequest::class)]
class DetachPermissionsFromRoleRequestTest extends UnitTestCase
{
    private DetachPermissionsFromRoleRequest $request;

    public function testAccess(): void
    {
        $this->assertSame([
            'permissions' => 'manage-roles',
            'roles' => null,
        ], $this->request->getAccessArray());
    }

    public function testDecode(): void
    {
        $this->assertSame([
            'role_id',
            'permissions_ids.*',
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
            'role_id' => 'required|exists:roles,id',
            'permissions_ids' => 'array|required',
            'permissions_ids.*' => 'exists:permissions,id',
        ], $rules);
    }

    public function testAuthorizeMethodGateCall(): void
    {
        $user = $this->getTestingUser(access: ['permissions' => 'manage-roles']);
        $request = DetachPermissionsFromRoleRequest::injectData([], $user);

        $this->assertTrue($request->authorize());
    }

    protected function setUp(): void
    {
        parent::setUp();

        $this->request = new DetachPermissionsFromRoleRequest();
    }
}
