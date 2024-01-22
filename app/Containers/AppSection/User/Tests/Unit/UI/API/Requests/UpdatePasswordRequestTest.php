<?php

namespace App\Containers\AppSection\User\Tests\Unit\UI\API\Requests;

use App\Containers\AppSection\User\Tests\UnitTestCase;
use App\Containers\AppSection\User\UI\API\Requests\UpdatePasswordRequest;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Password;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\Group;

#[Group('user')]
#[CoversClass(UpdatePasswordRequest::class)]
final class UpdatePasswordRequestTest extends UnitTestCase
{
    private UpdatePasswordRequest $request;

    public function testAccess(): void
    {
        $this->assertSame([
            'permissions' => null,
            'roles' => null,
        ], $this->request->getAccessArray());
    }

    public function testDecode(): void
    {
        $this->assertSame([
            'id',
        ], $this->request->getDecodeArray());
    }

    public function testUrlParametersArray(): void
    {
        $this->assertSame([
            'id',
        ], $this->request->getUrlParametersArray());
    }

    public function testValidationRules(): void
    {
        $rules = $this->request->rules();

        $this->assertEquals([
            'current_password' => [Rule::requiredIf(
                fn (): bool => null !== $this->request->user()->password,
            ), 'current_password:api'],
            'new_password' => [
                'required',
                Password::default(),
            ],
        ], $rules);
    }

    public function testAuthorizeMethodGateCall(): void
    {
        $user = $this->getTestingUserWithoutAccess();
        $request = UpdatePasswordRequest::injectData(['id' => $user->getHashedKey()], $user);

        $this->assertTrue($request->authorize());
    }

    protected function setUp(): void
    {
        parent::setUp();

        $this->request = new UpdatePasswordRequest();
    }
}
