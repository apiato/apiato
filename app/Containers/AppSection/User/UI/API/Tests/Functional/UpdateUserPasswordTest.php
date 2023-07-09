<?php

namespace App\Containers\AppSection\User\UI\API\Tests\Functional;

use App\Containers\AppSection\User\Notifications\PasswordUpdatedNotification;
use App\Containers\AppSection\User\UI\API\Tests\ApiTestCase;
use Illuminate\Support\Facades\Notification;
use Illuminate\Testing\Fluent\AssertableJson;

/**
 * @group user
 * @group api
 */
class UpdateUserPasswordTest extends ApiTestCase
{
    protected string $endpoint = 'patch@v1/users/{id}/password';

    protected array $access = [
        'permissions' => '',
        'roles' => '',
    ];

    public function testGivenUserAlreadyHaveAPasswordUpdateUserPassword(): void
    {
        Notification::fake();

        $user = $this->getTestingUser([
            'password' => 'Av@dakedavra!',
        ]);
        $data = [
            'current_password' => 'Av@dakedavra!',
            'new_password' => 'updated#Password111',
        ];

        $response = $this->injectId($user->id)->makeCall($data);

        $response->assertOk();
        $response->assertJson(
            fn (AssertableJson $json) => $json->has('data')
                ->where('data.object', 'User')
                ->where('data.email', $user->email)
                ->missing('data.password')
                ->etc()
        );

        Notification::assertSentTo($user, PasswordUpdatedNotification::class);
    }

    public function testNewPasswordFieldShouldBeRequired(): void
    {
        $user = $this->getTestingUser();
        $data = [
            'new_password' => '',
        ];

        $response = $this->injectId($user->id)->makeCall($data);

        $response->assertUnprocessable();
        $response->assertJson(
            fn (AssertableJson $json) => $json->has('errors')
                ->where('errors.new_password.0', 'The new password field is required.')
                ->etc()
        );
    }

    public function testGivenUserAlreadyHaveAPasswordCurrentPasswordFieldShouldBeRequired(): void
    {
        $user = $this->getTestingUser([
            'password' => 'Av@dakedavra!',
        ]);
        $data = [
            'new_password' => 'updated#Password111',
        ];

        $response = $this->injectId($user->id)->makeCall($data);

        $response->assertUnprocessable();
        $response->assertJson(
            fn (AssertableJson $json) => $json->has('errors')
                ->where('errors.current_password.0', 'The current password field is required.')
                ->etc()
        );
    }

    public function testGivenUserAlreadyHaveAPasswordCurrentPasswordFieldMustMatchUserCurrentPassword(): void
    {
        $user = $this->getTestingUser([
            'password' => 'Av@dakedavra!',
        ]);
        $data = [
            'current_password' => 'notMatchingP@ssw0rd',
            'new_password' => 'updated#Password111',
        ];

        $response = $this->injectId($user->id)->makeCall($data);

        $response->assertUnprocessable();
        $response->assertJson(
            fn (AssertableJson $json) => $json->has('errors')
                ->where('errors.current_password.0', 'The password is incorrect.')
                ->etc()
        );
    }

    public function testGivenUserDoesntHaveAPasswordCurrentPasswordFieldShouldBeProhibited(): void
    {
        $user = $this->getTestingUser([
            'password' => null,
        ]);
        $data = [
            'current_password' => 'sh0uldBeProhibited!!11',
            'new_password' => 'updated#Password111',
        ];

        $response = $this->injectId($user->id)->makeCall($data);

        $response->assertUnprocessable();
        $response->assertJson(
            fn (AssertableJson $json) => $json->has('errors')
                ->where('errors.current_password.0', 'The password is incorrect.')
                ->etc()
        );
    }
}
