<?php

namespace App\Containers\AppSection\Authentication\Tests\Functional\API;

use App\Containers\AppSection\Authentication\Notifications\Welcome;
use App\Containers\AppSection\Authentication\Tests\Functional\ApiTestCase;
use App\Containers\AppSection\Authentication\UI\API\Controllers\RegisterUserController;
use App\Containers\AppSection\User\Models\User;
use Illuminate\Auth\Notifications\VerifyEmail;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\URL;
use Illuminate\Testing\Fluent\AssertableJson;
use PHPUnit\Framework\Attributes\CoversClass;

#[CoversClass(RegisterUserController::class)]
final class RegisterUserTest extends ApiTestCase
{
    public function testRegisterNewUserWithCredentials(): void
    {
        Notification::fake();
        $data = [
            'email' => 'ganldalf@the.grey',
            'password' => 's3cr3tPa$$',
        ];

        $response = $this->postJson(URL::action(RegisterUserController::class), $data);

        $response->assertOk();
        $response->assertJson(
            static fn (AssertableJson $json): AssertableJson => $json->has('data')
                ->where('data.email', $data['email'])
                ->etc(),
        );
        $user = User::find(hashids()->decodeOrFail($response->json('data.id')));
        Notification::assertSentTo($user, Welcome::class);
        if (is_a(User::class, MustVerifyEmail::class, true)) {
            Notification::assertSentTo($user, VerifyEmail::class);
        }
    }

    public function testPreventsDuplicateEmailRegistration(): void
    {
        User::factory()->createOne(['email' => 'bigemail@email.com']);
        $data = [
            'email' => 'BiGeMaIl@EmAiL.CoM',
            'password' => 's3cr3tPa$$',
        ];

        $response = $this->postJson(URL::action(RegisterUserController::class), $data);

        $response->assertUnprocessable()->assertJsonValidationErrors('email');
    }
}
