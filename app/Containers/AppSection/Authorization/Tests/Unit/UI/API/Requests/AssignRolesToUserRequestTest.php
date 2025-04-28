<?php

declare(strict_types=1);

namespace App\Containers\AppSection\Authorization\Tests\Unit\UI\API\Requests;

use App\Containers\AppSection\Authorization\Tests\UnitTestCase;
use App\Containers\AppSection\Authorization\UI\API\Requests\AssignRolesToUserRequest;
use PHPUnit\Framework\Attributes\CoversClass;

#[CoversClass(AssignRolesToUserRequest::class)]
final class AssignRolesToUserRequestTest extends UnitTestCase
{
    private AssignRolesToUserRequest $request;

    public function testAccess(): void
    {
        $this->assertSame([
            'permissions' => 'manage-admins-access',
            'roles'       => null,
        ], $this->request->getAccessArray());
    }

    public function testDecode(): void
    {
        $this->assertSame([
            'user_id',
            'role_ids.*',
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
            'user_id'    => 'exists:users,id',
            'role_ids'   => 'array|required',
            'role_ids.*' => 'exists:roles,id',
        ], $rules);
    }

    public function testAuthorizeMethodGateCall(): void
    {
        $userModel = $this->getTestingUser(access: ['permissions' => 'manage-admins-access']);
        $assignRolesToUserRequest = AssignRolesToUserRequest::injectData([], $userModel);

        $this->assertTrue($assignRolesToUserRequest->authorize());
    }

    #[\Override]
    protected function setUp(): void
    {
        parent::setUp();

        $this->request = new AssignRolesToUserRequest();
    }
}
