<?php

namespace App\Port\Seeder\Loaders;

use App\Port\Foundation\Portals\Facade\PortButler;
use Illuminate\Database\Seeder as LaravelSeeder;

/**
 * Class Seeder.
 *
 * @author  Mahmoud Zalt <mahmoud@zalt.me>
 */
abstract class SeederLoaderAbstract extends LaravelSeeder
{

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

        foreach (PortButler::getContainersNames() as $containerName) {

            $containersDirectory = base_path('app/Containers/' . $containerName . $this->seedersPath);

            if (\File::isDirectory($containersDirectory)) {

                $files = \File::allFiles($containersDirectory);

                foreach ($files as $seederClass) {

                    if (\File::isFile($seederClass)) {

                        $pathName = $seederClass->getPathname();

                        $class = PortButler::getClassFullNameFromFile($pathName);

                        $this->call($class);
                    }

                }

            }
        }
    }

}
