<?php

namespace App\Containers\AppSection\Authorization\Tests\Unit\UI\API\Requests;

use App\Containers\AppSection\Authorization\Tests\UnitTestCase;
use App\Containers\AppSection\Authorization\UI\API\Requests\ListUserRolesRequest;
use PHPUnit\Framework\Attributes\CoversClass;

#[CoversClass(ListUserRolesRequest::class)]
final class ListUserRolesRequestTest extends UnitTestCase
{
    private ListUserRolesRequest $request;

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
        $user = $this->getTestingUserWithoutAccess();
        $request = ListUserRolesRequest::injectData([], $user)->withUrlParameters(['user_id' => $user->id]);

        $this->assertFalse($request->authorize());
    }

    protected function setUp(): void
    {
        parent::setUp();

        $this->request = new ListUserRolesRequest();
    }
}
