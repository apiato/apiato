<?php

declare(strict_types=1);

namespace App\Containers\AppSection\User\Tests\Unit\UI\API\Requests;

use App\Containers\AppSection\User\Tests\UnitTestCase;
use App\Containers\AppSection\User\UI\API\Requests\ListUsersRequest;
use PHPUnit\Framework\Attributes\CoversClass;

#[CoversClass(ListUsersRequest::class)]
final class ListUsersRequestTest extends UnitTestCase
{
    private ListUsersRequest $request;

    public function testDecode(): void
    {
        self::assertSame([], $this->request->getDecode());
    }

    public function testValidationRules(): void
    {
        $rules = $this->request->rules();

        self::assertSame([], $rules);
    }

    protected function setUp(): void
    {
        parent::setUp();

        $this->request = new ListUsersRequest();
    }
}
