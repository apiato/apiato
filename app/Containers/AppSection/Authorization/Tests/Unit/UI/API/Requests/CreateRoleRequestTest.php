<?php

namespace App\Containers\AppSection\Authorization\Tests\Unit\UI\API\Requests;

use App\Containers\AppSection\Authorization\Tests\UnitTestCase;
use App\Containers\AppSection\Authorization\UI\API\Requests\CreateRoleRequest;
use PHPUnit\Framework\Attributes\CoversClass;

#[CoversClass(CreateRoleRequest::class)]
final class CreateRoleRequestTest extends UnitTestCase
{
    private CreateRoleRequest $request;

    public function testDecode(): void
    {
        $this->assertSame([], $this->request->getDecodeArray());
    }

    public function testValidationRules(): void
    {
        $rules = $this->request->rules();

        $this->assertSame([
            'name' => 'required|unique:' . config('permission.table_names.roles') . ',name|min:2|max:20|alpha',
            'description' => 'max:255',
            'display_name' => 'max:100',
        ], $rules);
    }

    protected function setUp(): void
    {
        parent::setUp();

        $this->request = new CreateRoleRequest();
    }
}
