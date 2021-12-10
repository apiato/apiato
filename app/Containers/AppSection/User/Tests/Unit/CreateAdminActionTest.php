<?php

namespace App\Containers\AppSection\User\Tests\Unit;

use App\Containers\AppSection\User\Actions\CreateAdminAction;
use App\Containers\AppSection\User\Tests\TestCase;

/**
 * Class CreateAdminActionTest.
 *
 * @group user
 * @group unit
 */
class CreateAdminActionTest extends TestCase
{
    public function testCreateAdmin(): void
    {
        $data = [
            'email' => 'some@one.test',
            'password' => 'admin',
            'name' => 'Super Admin',
        ];

        $admin = app(CreateAdminAction::class)->run($data);

        $this->assertEquals($data['email'], $admin->email);
        $this->assertTrue($admin->hasRole(config('appSection-authorization.admin_role')));
        $this->assertNotNull($admin->email_verified_at);
    }
}
