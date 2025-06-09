<?php

declare(strict_types=1);

namespace App\Containers\AppSection\Authentication\Tests\Unit\UI\API\Requests\WebClient;

use App\Containers\AppSection\Authentication\Tests\UnitTestCase;
use App\Containers\AppSection\Authentication\UI\API\Requests\WebClient\IssueTokenRequest;
use PHPUnit\Framework\Attributes\CoversClass;

#[CoversClass(IssueTokenRequest::class)]
final class IssueTokenRequestTest extends UnitTestCase
{
    private IssueTokenRequest $request;

    public function testDecode(): void
    {
        self::assertSame([], $this->request->getDecode());
    }

    public function testValidationRules(): void
    {
        self::assertSame([
            'email'    => ['required', 'email'],
            'password' => 'required',
        ], $this->request->rules());
    }

    protected function setUp(): void
    {
        parent::setUp();

        $this->request = new IssueTokenRequest();
    }
}
