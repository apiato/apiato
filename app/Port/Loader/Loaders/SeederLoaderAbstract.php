<?php

namespace App\Port\Loader\Loaders;

use App\Port\Loader\Helpers\Facade\LoaderHelper;
use Illuminate\Database\Seeder as LaravelSeeder;

/**
 * Class Seeder.
 *
 * This Class has inverted dependency :( you must extend this class from the default
 * seeder class provided by the framework (database/seeds/DatabaseSeeder.php)
 *
 * @author  Mahmoud Zalt <mahmoud@zalt.me>
 */
abstract class SeederLoaderAbstract extends LaravelSeeder
{

    /**
     * Default seeders directory for containers and port
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
        $this->loadSeedersFromContainers();
        $this->loadSeedersFromPort();
    }

    /**
     * loadSeedersFromContainers
     */
    private function loadSeedersFromContainers()
    {
        foreach (LoaderHelper::getContainersNames() as $containerName) {

            $containersDirectory = base_path('app/Containers/' . $containerName . $this->seedersPath);

            $this->loadSeeds($containersDirectory);
        }
    }

    /**
     *
     */
    private function loadSeedersFromPort()
    {
        // it has to do it's own loop for now
        foreach (LoaderHelper::getPortFoldersNames() as $portFolderName) {

            $portSeedersDirectory = base_path('app/Port/') . $portFolderName . $this->seedersPath;

            $this->loadSeeds($portSeedersDirectory);
        }

    }

    /**
     * @param $directory
     */
    private function loadSeeds($directory)
    {
        if (\File::isDirectory($directory)) {

            $files = \File::allFiles($directory);

            foreach ($files as $seederClass) {

                if (\File::isFile($seederClass)) {

                    $seederClass = LoaderHelper::getClassFullNameFromFile($seederClass->getPathname());

                    // seed it
                    $this->call($seederClass);
                }

            }

        }

    }

}
