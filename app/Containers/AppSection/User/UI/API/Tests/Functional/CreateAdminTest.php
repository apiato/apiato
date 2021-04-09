<?php

namespace App\Containers\AppSection\User\UI\API\Tests\Functional;

use App\Containers\AppSection\User\Models\User;
use App\Containers\AppSection\User\Tests\ApiTestCase;

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

        $response = $this->makeCall($data);

        $response->assertStatus(200);
        $this->assertResponseContainKeyValue([
            'email' => $data['email'],
            'name' => $data['name'],
        ]);

        $this->assertResponseContainKeys(['id']);
        $this->assertDatabaseHas('users', ['email' => $data['email']]);
        $user = User::where(['email' => $data['email']])->first();
        self::assertEquals(true, $user->is_admin);
    }
}
