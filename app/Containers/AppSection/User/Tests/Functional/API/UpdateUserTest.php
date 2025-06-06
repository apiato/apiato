<?php

namespace App\Containers\AppSection\User\Tests\Functional\API;

use App\Containers\AppSection\User\Enums\Gender;
use App\Containers\AppSection\User\Models\User;
use App\Containers\AppSection\User\Tests\Functional\ApiTestCase;
use App\Containers\AppSection\User\UI\API\Controllers\UpdateUserController;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\URL;
use Illuminate\Testing\Fluent\AssertableJson;
use PHPUnit\Framework\Attributes\CoversClass;

#[CoversClass(UpdateUserController::class)]
final class UpdateUserTest extends ApiTestCase
{
    public function testCanUpdateAsOwner(): void
    {
        $user = User::factory()->createOne([
            'name' => 'He who must not be named',
            'gender' => Gender::FEMALE,
            'password' => 'Av@dakedavra!',
        ]);
        $this->actingAs($user);
        $data = [
            'name' => 'Updated Name',
            'gender' => Gender::MALE->value,
            'birth' => Date::today()->toIso8601String(),
            'current_password' => 'Av@dakedavra!',
            'new_password' => 'updated#Password111',
            'new_password_confirmation' => 'updated#Password111',
        ];

        $response = $this->patchJson(URL::action(UpdateUserController::class, $user->getHashedKey()), $data);

        $response->assertOk();
        $response->assertJson(
            fn (AssertableJson $json): AssertableJson => $json->has(
                'data',
                fn (AssertableJson $json): AssertableJson => $json
                    ->where('type', 'User')
                    ->where('email', $user->email)
                    ->where('name', $data['name'])
                    ->where('gender', $data['gender'])
                    ->where('birth', static fn ($birth) => Date::parse($data['birth'])->isSameDay($birth))
                    ->missing('password')
                    ->etc(),
            )->etc(),
        );
        $this->assertTrue(Hash::check($data['new_password'], $user->refresh()->password));
    }

    // TODO: move to request test
    public function testGivenUserHasNoAccessPreventsOperation(): void
    {
        $this->actingAs(User::factory()->createOne());

        $response = $this->patchJson(URL::action(UpdateUserController::class, User::factory()->createOne()->getHashedKey()));

        $response->assertForbidden();
    }
}
