<?php

namespace App\Containers\Authorization\UI\API\Tests\Functional;

use App\Containers\Authorization\Models\Role;
use App\Containers\Authorization\Tests\TestCase;
use App\Containers\User\Models\User;

/**
 * Class RevokeUserFromRoleTest.
 *
 * @author  Mahmoud Zalt <mahmoud@zalt.me>
 */
class RevokeUserFromRoleTest extends TestCase
{

    protected $endpoint = 'post@roles/revoke';

    protected $access = [
        'roles'       => 'admin',
        'permissions' => '',
    ];

    public function testRevokeUserFromRole_()
    {
        $roleA = factory(Role::class)->create();

        $randomUser = factory(User::class)->create();
        $randomUser->assignRole($roleA);

        $data = [
            'roles_ids' => [$roleA->getHashedKey()],
            'user_id'   => $randomUser->getHashedKey(),
        ];

        // send the HTTP request
        $response = $this->makeCall($data);

        // assert response status is correct
        $this->assertEquals('200', $response->getStatusCode());

        $responseContent = $this->getResponseContent($response);

        $this->assertEquals($data['user_id'], $responseContent->data->id);

        $this->missingFromDatabase('user_has_roles', [
            'user_id' => $randomUser->id,
            'role_id' => $roleA->id,
        ]);
    }

    public function testRevokeUserFromRoleWithRealId_()
    {
        $roleA = factory(Role::class)->create();

        $randomUser = factory(User::class)->create();
        $randomUser->assignRole($roleA);

        $data = [
            'roles_ids' => [$roleA->id],
            'user_id'   => $randomUser->id,
        ];

        // send the HTTP request
        $response = $this->makeCall($data);


        // assert response status is correct. Note: this will return 200 if `HASH_ID=false` in the .env
        if(\Config::get('hello.hash-id')){
            $this->assertEquals('400', $response->getStatusCode());

            $this->assertResponseContainKeyValue([
                'message' => 'Only Hashed ID\'s allowed (roles_ids.*).',
            ], $response);
        }else{
            $this->assertEquals('200', $response->getStatusCode());
        }

    }

    public function testRevokeUserFromManyRoles_()
    {
        $roleA = factory(Role::class)->create();
        $roleB = factory(Role::class)->create();

        $randomUser = factory(User::class)->create();
        $randomUser->assignRole($roleA);
        $randomUser->assignRole($roleB);

        $data = [
            'roles_ids' => [$roleA->getHashedKey(), $roleB->getHashedKey()],
            'user_id'   => $randomUser->getHashedKey(),
        ];

        // send the HTTP request
        $response = $this->makeCall($data);

        // assert response status is correct
        $this->assertEquals('200', $response->getStatusCode());

        $this->missingFromDatabase('user_has_roles', [
            'user_id' => $randomUser->id,
            'role_id' => $roleB->id,
            'role_id' => $roleA->id,
        ]);

    }

}
