<?php

declare(strict_types=1);

namespace App\Containers\AppSection\Authorization\Tests\Unit\Configs;

use App\Containers\AppSection\Authorization\Models\Permission;
use App\Containers\AppSection\Authorization\Models\Role;
use App\Ship\Tests\ShipTestCase;
use PHPUnit\Framework\Attributes\CoversNothing;

#[CoversNothing]
final class PermissionConfigTest extends ShipTestCase
{
    public function testConfigHasCorrectValues(): void
    {
        $config = config('permission');
        $expected = [
            'models' => [
                'permission' => Permission::class,
                'role'       => Role::class,
            ],
            'table_names' => [
                'roles'                 => 'roles',
                'permissions'           => 'permissions',
                'model_has_permissions' => 'model_has_permissions',
                'model_has_roles'       => 'model_has_roles',
                'role_has_permissions'  => 'role_has_permissions',
            ],
            'column_names' => [
                'role_pivot_key'       => null, // default 'role_id',
                'permission_pivot_key' => null, // default 'permission_id',
                'model_morph_key'      => 'model_id',
                'team_foreign_key'     => 'team_id',
            ],
            'register_permission_check_method' => true,
            'teams'                            => false,
            'display_permission_in_exception'  => false,
            'display_role_in_exception'        => false,
            'enable_wildcard_permission'       => false,
            'cache'                            => [
                'expiration_time' => \DateInterval::createFromDateString('24 hours'),
                'key'             => 'spatie.permission.cache',
                'store'           => 'default',
            ],
        ];

        $this->assertEquals($expected, $config);
    }
}
