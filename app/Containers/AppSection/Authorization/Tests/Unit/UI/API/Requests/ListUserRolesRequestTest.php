<?php

declare(strict_types=1);

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
        self::assertSame([
            'user_id',
        ], $this->request->getDecode());
    }

    public function testValidationRules(): void
    {
        $rules = $this->request->rules();

        self::assertSame([], $rules);
    }

    protected function setUp(): void
    {
        parent::setUp();

        $this->request = new ListUserRolesRequest();
    }
}
