<?php

namespace App\Containers\AppSection\Authorization\Tests\Unit\Data\Seeders;

use App\Containers\AppSection\Authorization\Data\Seeders\AuthorizationRolesSeeder_2;
use App\Containers\AppSection\Authorization\Tests\UnitTestCase;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\Group;

#[Group('authorization')]
#[CoversClass(AuthorizationRolesSeeder_2::class)]
final class AuthorizationRolesSeederTest extends UnitTestCase
{
    public function testCanSeed(): void
    {
        $data = [
            ['admin', 'Administrator', 'Administrator Role', 999],
        ];

        foreach (array_keys(config('auth.guards')) as $guardName) {
            foreach ($data as $datum) {
                $this->assertDatabaseHas('roles', [
                    'name' => $datum[0],
                    'description' => $datum[1],
                    'display_name' => $datum[2],
                    'guard_name' => $guardName,
                ]);
            }
        }
        $this->assertDatabaseCount('roles', count($data) * count(config('auth.guards')));
    }
}
