<?php

namespace App\Containers\AppSection\Authentication\Tests\Unit\UI\API\Requests\EmailVerification;

use App\Containers\AppSection\Authentication\Tests\UnitTestCase;
use App\Containers\AppSection\Authentication\UI\API\Requests\EmailVerification\SendRequest;
use PHPUnit\Framework\Attributes\CoversClass;

#[CoversClass(SendRequest::class)]
final class SendRequestTest extends UnitTestCase
{
    private SendRequest $request;

    public function testDecode(): void
    {
        $this->assertSame([], $this->request->getDecode());
    }

    public function testValidationRules(): void
    {
        $this->assertEquals([], $this->request->rules());
    }

    protected function setUp(): void
    {
        parent::setUp();

        $this->request = new SendRequest();
    }
}
