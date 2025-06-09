<?php

declare(strict_types=1);

namespace App\Containers\AppSection\Authorization\Tests\Unit\UI\API\Requests;

use App\Containers\AppSection\Authorization\Tests\UnitTestCase;
use App\Containers\AppSection\Authorization\UI\API\Requests\ListPermissionsRequest;
use PHPUnit\Framework\Attributes\CoversClass;

#[CoversClass(ListPermissionsRequest::class)]
final class ListPermissionsRequestTest extends UnitTestCase
{
    private ListPermissionsRequest $request;

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

        $this->request = new ListPermissionsRequest();
    }
}
