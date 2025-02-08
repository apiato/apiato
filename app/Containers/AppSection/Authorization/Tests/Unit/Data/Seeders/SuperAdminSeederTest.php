<?php

namespace App\Containers\AppSection\Authorization\Tests\Unit\Data\Seeders;

use App\Containers\AppSection\Authorization\Data\Seeders\SuperAdminSeeder_2;
use App\Containers\AppSection\Authorization\Tests\UnitTestCase;
use App\Containers\AppSection\User\Actions\CreateAdminAction;
use PHPUnit\Framework\Attributes\CoversClass;

#[CoversClass(SuperAdminSeeder_2::class)]
final class SuperAdminSeederTest extends UnitTestCase
{
    public function testSeedsSuperAdmin(): void
    {
        $actionSpy = $this->spy(CreateAdminAction::class);
        $seeder = new SuperAdminSeeder_2();

        $seeder->run($actionSpy);

        $actionSpy->shouldHaveReceived('run')->once()->with([
            'email' => 'admin@admin.com',
            'password' => config('appSection-authorization.admin_role'),
            'name' => 'Super Admin',
        ]);
    }
}
