<?php

declare(strict_types=1);

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
        self::assertSame([], $this->request->getDecode());
    }

    public function testValidationRules(): void
    {
        self::assertSame([], $this->request->rules());
    }

    protected function setUp(): void
    {
        parent::setUp();

        $this->request = new SendRequest();
    }
}
