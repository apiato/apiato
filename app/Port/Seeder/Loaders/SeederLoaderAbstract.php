<?php

namespace App\Port\Seeder\Loaders;

use App\Port\Foundation\Portals\Facade\PortButler;
use App\Port\Seeder\Testing\LiveTestingSeeder;
use Illuminate\Database\Seeder as LaravelSeeder;

/**
 * Class Seeder.
 *
 * @author  Mahmoud Zalt <mahmoud@zalt.me>
 */
abstract class SeederLoaderAbstract extends LaravelSeeder
{

    /**
     * Manually seeding some Port Seeders whenever needed
     *
     * @var  array
     */
    protected $portSeedersClasses = [
        LiveTestingSeeder::class,
    ];

    /**
     * Default seeders directory in the container
     *
     * @var  string
     */
    protected $seedersPath = '/Data/Seeders';

    /**
     * Run the database seeds.
     * Then Automatically register all Seeders from Containers.
     *
     * @return void
     */
    public function run()
    {
        $this->seedContainers();
        $this->seedPort();
    }

    /**
     *
     */
    private function seedContainers()
    {
        foreach (PortButler::getContainersNames() as $containerName) {

            $containersDirectory = base_path('app/Containers/' . $containerName . $this->seedersPath);

            if (\File::isDirectory($containersDirectory)) {

                $files = \File::allFiles($containersDirectory);

                foreach ($files as $seederClass) {

                    if (\File::isFile($seederClass)) {

                        $pathName = $seederClass->getPathname();

                        $seederClass = PortButler::getClassFullNameFromFile($pathName);

                        $this->seed($seederClass);
                    }

                }

            }
        }
    }

    /**
     *
     */
    private function seedPort()
    {
        foreach ($this->portSeedersClasses as $seederClass) {
            $this->seed($seederClass);
        }
    }

    /**
     * @param $class
     */
    private function seed($class)
    {
        $this->call($class);
    }

}
