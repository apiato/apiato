<?php

namespace App\Containers\AppSection\Authorization\Tests\Unit\UI\API\Requests;

use App\Containers\AppSection\Authorization\Tests\UnitTestCase;
use App\Containers\AppSection\Authorization\UI\API\Requests\GivePermissionsToRoleRequest;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\Group;

#[Group('authorization')]
#[CoversClass(GivePermissionsToRoleRequest::class)]
final class GivePermissionsToRoleRequestTest extends UnitTestCase
{
    private GivePermissionsToRoleRequest $request;

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
            'permission_ids.*',
        ], $this->request->getDecodeArray());
    }

    public function testUrlParametersArray(): void
    {
        $this->assertSame([
            'role_id',
        ], $this->request->getUrlParametersArray());
    }

    public function testValidationRules(): void
    {
        $rules = $this->request->rules();

        $this->assertSame([
            'role_id' => 'exists:roles,id',
            'permission_ids' => 'array|required',
            'permission_ids.*' => 'exists:permissions,id',
        ], $rules);
    }

    public function testAuthorizeMethodGateCall(): void
    {
        $user = $this->getTestingUser(access: ['permissions' => 'manage-roles']);
        $request = GivePermissionsToRoleRequest::injectData([], $user);

        $this->assertTrue($request->authorize());
    }

    protected function setUp(): void
    {
        parent::setUp();

        $this->request = new GivePermissionsToRoleRequest();
    }
}
