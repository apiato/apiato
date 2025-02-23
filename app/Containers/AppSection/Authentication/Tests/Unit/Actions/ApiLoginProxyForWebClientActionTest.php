<?php

namespace App\Containers\AppSection\Authentication\Tests\Unit\Actions;

use App\Containers\AppSection\Authentication\Actions\ApiLoginProxyForWebClientAction;
use App\Containers\AppSection\Authentication\Exceptions\LoginFailed;
use App\Containers\AppSection\Authentication\Tests\UnitTestCase;
use App\Containers\AppSection\User\Models\User;
use PHPUnit\Framework\Attributes\CoversClass;

#[CoversClass(ApiLoginProxyForWebClientAction::class)]
final class ApiLoginProxyForWebClientActionTest extends UnitTestCase
{
    protected function setUp(): void
    {
        parent::setUp();

        $this->setupPasswordGrantClient();
    }

    public function testCanLogin(): void
    {
        $credentials = [
            'email' => 'ganldalf@the.grey',
            'password' => 'youShallNotPass',
        ];
        $user = User::factory()->createOne($credentials);
        $this->actingAs($user, 'web');
        $action = app(ApiLoginProxyForWebClientAction::class);

        $response = $action->run($this->mergeProxyData($credentials));

        $this->assertSame('refreshToken', $response->refreshTokenCookie->getName());
    }

    public function testCanLoginWithMultipleCorrectLoginFields(): void
    {
        config()->set('appSection-authentication.login.fields', ['email' => [], 'name' => []]);
        $credentials = [
            'email' => 'ganldalf@the.grey', // correct email
            'name' => 'gandalf', // correct name
            'password' => 'youShallNotPass',
        ];
        $user = User::factory()->createOne($credentials);
        $this->actingAs($user, 'web');
        $action = app(ApiLoginProxyForWebClientAction::class);

        $response = $action->run($this->mergeProxyData($credentials));

        $this->assertSame('refreshToken', $response->refreshTokenCookie->getName());
    }

    public function testCannotLoginWithMultipleWrongLoginFields(): void
    {
        $this->expectException(LoginFailed::class);

        config()->set('appSection-authentication.login.fields', ['email' => [], 'name' => []]);
        $userDetails = [
            'email' => 'ganldalf@the.grey',
            'name' => 'gandalf',
            'password' => 'youShallNotPass',
        ];
        $user = User::factory()->createOne($userDetails);
        $this->actingAs($user, 'web');
        $credentials = [
            'email' => 'ganldalf@the.white', // wrong email
            'name' => 'saruman', // wrong name
            'password' => 'youShallNotPass',
        ];
        $action = app(ApiLoginProxyForWebClientAction::class);

        $action->run($this->mergeProxyData($credentials));
    }

    public function testCanLoginWithMultipleLoginFieldsEvenIfOneFieldIsCorrect(): void
    {
        config()->set('appSection-authentication.login.fields', ['email' => [], 'name' => []]);
        $userDetails = [
            'email' => 'ganldalf@the.grey',
            'name' => 'gandalf',
            'password' => 'youShallNotPass',
        ];
        $user = User::factory()->createOne($userDetails);
        $this->actingAs($user, 'web');
        $credentials = [
            'email' => 'ganldalf@the.white', // wrong email
            'name' => 'gandalf', // correct name
            'password' => 'youShallNotPass',
        ];
        $action = app(ApiLoginProxyForWebClientAction::class);

        $response = $action->run($this->mergeProxyData($credentials));

        $this->assertSame('refreshToken', $response->refreshTokenCookie->getName());
    }

    private function mergeProxyData(array $data): array
    {
        return array_merge($data, [
            ...array_keys(config('appSection-authentication.login.fields')),
            'password',
            'client_id' => config('appSection-authentication.clients.web.id'),
            'client_secret' => config('appSection-authentication.clients.web.secret'),
            'grant_type' => 'password',
            'scope' => '',
        ]);
    }
}
