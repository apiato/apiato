<?php

use App\Ship\Engine\Loaders\SeederLoaderTrait;
use Illuminate\Database\Seeder as LaravelSeeder;

/**
 * Class DatabaseSeeder
 *
 * @author  Mahmoud Zalt  <mahmoud@zalt.me>
 */
class DatabaseSeeder extends LaravelSeeder
{
    use SeederLoaderTrait;

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->runLoadingSeeders();
    }
}
