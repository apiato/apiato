<?php

namespace App\Containers\AppSection\Authorization\Tests\Unit\UI\API\Requests;

use App\Containers\AppSection\Authorization\Tests\UnitTestCase;
use App\Containers\AppSection\Authorization\UI\API\Requests\SyncUserRolesRequest;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\Group;

#[Group('authorization')]
#[CoversClass(SyncUserRolesRequest::class)]
class SyncUserRolesRequestTest extends UnitTestCase
{
    private SyncUserRolesRequest $request;

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
            'user_id',
            'roles_ids.*',
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
        $request = SyncUserRolesRequest::injectData([], $user);

        $this->assertTrue($request->authorize());
    }

    protected function setUp(): void
    {
        parent::setUp();

        $this->request = new SyncUserRolesRequest();
    }
}
