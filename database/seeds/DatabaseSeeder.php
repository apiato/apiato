<?php

use App\Port\Seeder\Abstracts\Seeder;
use App\Containers\Authorization\Seeders\RolesAndPermissionsSeeder;

/**
 * Class DatabaseSeeder
 *
 * @author  Mahmoud Zalt  <mahmoud@zalt.me>
 */
class DatabaseSeeder extends Seeder
{

    /**
     * The application Seeders that needs to be registered.
     *
     * @var array
     */
    protected $seeders = [
        RolesAndPermissionsSeeder::class,
    ];

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach ($this->seeders as $seeder) {
            $this->call($seeder);
        }
    }
}
