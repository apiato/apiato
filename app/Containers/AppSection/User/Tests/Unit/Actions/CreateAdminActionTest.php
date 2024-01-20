<?php

namespace App\Containers\AppSection\User\Tests\Unit\Actions;

use App\Containers\AppSection\User\Actions\CreateAdminAction;
use App\Containers\AppSection\User\Tests\UnitTestCase;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\Group;

#[Group('user')]
#[CoversClass(CreateAdminAction::class)]
final class CreateAdminActionTest extends UnitTestCase
{
    public function testCreateAdmin(): void
    {
        $data = [
            'email' => 'some@one.test',
            'password' => 'admin',
            'name' => 'Super Admin',
        ];

        $admin = app(CreateAdminAction::class)->run($data);

        $this->assertSame($data['email'], $admin->email);
        $this->assertTrue($admin->hasRole(config('appSection-authorization.admin_role')));
        $this->assertNotNull($admin->email_verified_at);
    }

    public function testGivenInvalidDataThrowExceptionAndRollbackAllCommits(): void
    {
        $this->expectException(\Exception::class);

        // update Admin role name to a not existing role (different from what is seeded for admin role),
        // so we can get an error
        config(['appSection-authorization.admin_role' => 'not_existing_role']);

        $data = [
            'email' => 'a@new.email',
            'password' => 'admin',
            'name' => 'Super Admin',
        ];

        $admin = app(CreateAdminAction::class)->run($data);

        $this->assertModelMissing($admin);
    }
}
