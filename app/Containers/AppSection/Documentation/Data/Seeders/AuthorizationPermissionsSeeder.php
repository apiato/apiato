<?php

namespace App\Containers\AppSection\Documentation\Data\Seeders;

use Apiato\Core\Foundation\Facades\Apiato;
use App\Ship\Parents\Seeders\Seeder;

class AuthorizationPermissionsSeeder extends Seeder
{
    public function run(): void
    {
        Apiato::call('Authorization@CreatePermissionTask', ['access-private-docs', 'Access the private docs.']);
    }
}
