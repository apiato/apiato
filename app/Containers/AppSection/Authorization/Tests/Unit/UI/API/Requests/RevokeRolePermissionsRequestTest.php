<?php

declare(strict_types=1);

namespace App\Containers\AppSection\Authorization\Tests\Unit\UI\API\Requests;

use App\Containers\AppSection\Authorization\Tests\UnitTestCase;
use App\Containers\AppSection\Authorization\UI\API\Requests\RevokeRolePermissionsRequest;
use PHPUnit\Framework\Attributes\CoversClass;

#[CoversClass(RevokeRolePermissionsRequest::class)]
final class RevokeRolePermissionsRequestTest extends UnitTestCase
{
    private RevokeRolePermissionsRequest $request;

    public function testAccess(): void
    {
        $this->assertSame([
            'permissions' => 'manage-roles',
            'roles'       => null,
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
            'role_id'          => 'exists:roles,id',
            'permission_ids'   => 'array|required',
            'permission_ids.*' => 'exists:permissions,id',
        ], $rules);
    }

    public function testAuthorizeMethodGateCall(): void
    {
        $userModel = $this->getTestingUser(access: ['permissions' => 'manage-roles']);
        $revokeRolePermissionsRequest = RevokeRolePermissionsRequest::injectData([], $userModel);

        $this->assertTrue($revokeRolePermissionsRequest->authorize());
    }

    #[\Override]
    protected function setUp(): void
    {
        parent::setUp();

        $this->request = new RevokeRolePermissionsRequest();
    }
}
