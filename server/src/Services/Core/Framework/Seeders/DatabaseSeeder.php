<?php

namespace Mega\Services\Core\Framework\Seeders;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Seeder;
use Mega\Services\Authorization\Seeders\SeedRolesAndPermissions;

/**
 * Class DatabaseSeeder
 *
 * @author Mahmoud Zalt <mahmoud@zalt.me>
 */
class DatabaseSeeder extends Seeder
{

    /**
     * The application Seeders that needs to be registered
     *
     * @var array
     */
    protected $seeders = [
        SeedRolesAndPermissions::class
    ];

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        foreach ($this->seeders as $seeder) {
            $this->call($seeder);
        }

        Model::reguard();
    }
}
