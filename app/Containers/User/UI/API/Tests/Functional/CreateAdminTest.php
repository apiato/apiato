<?php

namespace App\Containers\User\UI\API\Tests\Functional;

use App\Containers\User\Models\User;
use App\Containers\User\Tests\TestCase;

/**
 * Class CreateAdminTest.
 *
 * @author Mahmoud Zalt <mahmoud@zalt.me>
 */
class CreateAdminTest extends TestCase
{

    protected $endpoint = 'post@v1/admins';

    protected $access = [
        'permissions' => 'create-admins',
        'roles'       => '',
    ];

    public function testCreateAdmin_()
    {
        $data = [
            'email'    => 'apiato@admin.dev',
            'name'     => 'admin',
            'password' => 'secret',
        ];

        // send the HTTP request
        $response = $this->makeCall($data);

        // assert response status is correct
        $response->assertStatus(200);

        $this->assertResponseContainKeyValue([
            'email' => $data['email'],
            'name'  => $data['name'],
        ]);

        // assert response contain the token
        $this->assertResponseContainKeys(['id']);

        // assert the data is stored in the database
        $this->assertDatabaseHas('users', ['email' => $data['email']]);

        $user = User::where(['email' => $data['email']])->first();

        $this->assertEquals($user->is_client, false);
    }

}
