<?php

namespace App\Containers\AppSection\User\UI\API\Tests\Functional;

use App\Containers\AppSection\User\Models\User;
use App\Containers\AppSection\User\UI\API\Tests\ApiTestCase;
use Illuminate\Testing\Fluent\AssertableJson;

/**
 * Class CreateAdminTest.
 *
 * @group user
 * @group api
 */
class CreateAdminTest extends ApiTestCase
{
    protected string $endpoint = 'post@v1/admins';

    protected array $access = [
        'permissions' => 'create-admins',
        'roles' => '',
    ];

    public function testCreateAdmin(): void
    {
        $data = [
            'email' => 'apiato@admin.test',
            'name' => 'admin',
            'password' => 'secret',
        ];

        $response = $this->endpoint($this->endpoint . '?include=roles')->makeCall($data);

        $response->assertStatus(200);
        $response->assertJson(
            fn (AssertableJson $json) =>
                $json->has('data')
                    ->where('data.object', 'User')
                    ->where('data.email', $data['email'])
                    ->where('data.name', $data['name'])
                    ->count('data.roles.data', 1)
                    ->where('data.roles.data.0.name', config('appSection-authorization.admin_role'))
                    ->etc()
        );
    }
}
