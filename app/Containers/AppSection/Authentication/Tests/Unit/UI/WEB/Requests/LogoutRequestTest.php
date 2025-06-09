<?php

declare(strict_types=1);

namespace App\Containers\AppSection\Authentication\Tests\Unit\UI\WEB\Requests;

use App\Containers\AppSection\Authentication\Tests\UnitTestCase;
use App\Containers\AppSection\Authentication\UI\WEB\Requests\LogoutRequest;
use PHPUnit\Framework\Attributes\CoversClass;

#[CoversClass(LogoutRequest::class)]
final class LogoutRequestTest extends UnitTestCase
{
    private LogoutRequest $request;

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

        $this->request = new LogoutRequest();
    }
}
