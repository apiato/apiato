<?php

namespace App\Containers\AppSection\Authentication\Tests\Functional\API\WebClient;

use App\Containers\AppSection\Authentication\Data\Factories\ClientFactory;
use App\Containers\AppSection\Authentication\Tests\Functional\ApiTestCase;
use App\Containers\AppSection\Authentication\UI\API\Controllers\WebClient\IssueTokenController;
use App\Containers\AppSection\User\Models\User;
use Illuminate\Testing\Fluent\AssertableJson;
use PHPUnit\Framework\Attributes\CoversClass;

#[CoversClass(IssueTokenController::class)]
final class IssueTokenTest extends ApiTestCase
{
    public function testProxyLogin(): void
    {
        ClientFactory::webClient();
        $data = [
            'email' => 'gandalf@the.grey',
            'password' => 'youShallNotPass',
        ];
        User::factory()->createOne($data);

        $response = $this->postJson(action(IssueTokenController::class), $data);

        $response->assertOk();
        $response->assertJson(
            static fn (AssertableJson $json): AssertableJson => $json->has(
                'data',
                static fn (AssertableJson $json): AssertableJson => $json->hasAll([
                    'access_token',
                    'refresh_token',
                    'token_type',
                    'expires_in',
                ])->where('token_type', 'Bearer')
                ->etc(),
            )->etc(),
        );
    }
}
