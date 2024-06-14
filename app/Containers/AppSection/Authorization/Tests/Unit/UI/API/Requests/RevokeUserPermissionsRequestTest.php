<?php

namespace App\Containers\AppSection\Authorization\Tests\Unit\UI\API\Requests;

use App\Containers\AppSection\Authorization\Tests\UnitTestCase;
use App\Containers\AppSection\Authorization\UI\API\Requests\RevokeUserPermissionsRequest;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\Group;

#[Group('authorization')]
#[CoversClass(RevokeUserPermissionsRequest::class)]
final class RevokeUserPermissionsRequestTest extends UnitTestCase
{
    private RevokeUserPermissionsRequest $request;

    public function testAccess(): void
    {
        $this->assertSame([
            'permissions' => 'manage-permissions',
            'roles' => null,
        ], $this->request->getAccessArray());
    }

    public function testDecode(): void
    {
        $this->assertSame([
            'user_id',
            'permission_ids.*',
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

        $this->assertSame([
            'user_id' => 'exists:users,id',
            'permission_ids' => 'array|required',
            'permission_ids.*' => 'exists:permissions,id',
        ], $rules);
    }

    public function testAuthorizeMethodGateCall(): void
    {
        $user = $this->getTestingUser(access: ['permissions' => 'manage-permissions']);
        $request = RevokeUserPermissionsRequest::injectData([], $user)->withUrlParameters(['user_id' => $user->id]);

        $this->assertTrue($request->authorize());
    }

    protected function setUp(): void
    {
        parent::setUp();

        $this->request = new RevokeUserPermissionsRequest();
    }
}
