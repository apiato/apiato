<?php

namespace App\Ship\Loader\Loaders;

use App\Ship\Loader\Helpers\Facade\LoaderHelper;
use File;
use Illuminate\Support\Collection;

/**
 * Class SeederLoaderTrait.
 *
 * This Class has inverted dependency :( you must extend this class from the default
 * seeder class provided by the framework (database/seeds/DatabaseSeeder.php)
 *
 * @author  Mahmoud Zalt <mahmoud@zalt.me>
 */
trait SeederLoaderTrait
{

    /**
     * Default seeders directory for containers and port
     *
     * @var  string
     */
    protected $seedersPath = '/Data/Seeders';

    /**
     * runLoadingSeeders
     */
    public function runLoadingSeeders()
    {
        $this->loadSeedersFromContainers();
        $this->loadSeedersFromPort();
    }

    /**
     * loadSeedersFromContainers
     */
    private function loadSeedersFromContainers()
    {
        $seedersClasses = new Collection();

        foreach (LoaderHelper::getContainersNames() as $containerName) {

            $containersDirectories[] = base_path('app/Containers/' . $containerName . $this->seedersPath);

        }

        $seedersClasses = $this->findSeedersClasses($containersDirectories, $seedersClasses);
        $orderedSeederClasses = $this->sortSeeders($seedersClasses);

        $this->loadSeeders($orderedSeederClasses);
    }

    /**
     * loadSeedersFromPort
     */
    private function loadSeedersFromPort()
    {
        $seedersClasses = new Collection();

        // it has to do it's own loop for now
        foreach (LoaderHelper::getPortFoldersNames() as $portFolderName) {

            $containersDirectories[] = base_path('app/Ship/') . $portFolderName . $this->seedersPath;
        }

        $seedersClasses = $this->findSeedersClasses($containersDirectories, $seedersClasses);
        $orderedSeederClasses = $this->sortSeeders($seedersClasses);

        $this->loadSeeders($orderedSeederClasses);
    }

    /**
     * @param array $directories
     * @param       $seedersClasses
     *
     * @return  mixed
     */
    private function findSeedersClasses(array $directories, $seedersClasses)
    {
        foreach ($directories as $directory) {

            if (File::isDirectory($directory)) {

                $files = File::allFiles($directory);

                foreach ($files as $seederClass) {

                    if (File::isFile($seederClass)) {

                        // do not seed the classes now, just store them in a collection and w
                        $seedersClasses->push(
                            LoaderHelper::getClassFullNameFromFile(
                                $seederClass->getPathname())
                        );
                    }
                }
            }
        }

        return $seedersClasses;
    }

    /**
     * @param $seedersClasses
     *
     * @return  \Illuminate\Support\Collection|static
     */
    private function sortSeeders($seedersClasses)
    {
        $orderedSeederClasses = new Collection();

        if (!$seedersClasses->isEmpty()) {

            foreach ($seedersClasses as $key => $seederFullClassName) {
                // if the class full namespace contain "_" it means it needs to be seeded in order
                if (preg_match('/_/', $seederFullClassName)) {
                    // move all the seeder classes that needs to be seeded in order to their own Collection
                    $orderedSeederClasses->push($seederFullClassName);
                    // delete the moved classes from the original collection
                    $seedersClasses->forget($key);
                }
            }

            // sort the classes that needed to be ordered
            $orderedSeederClasses = $orderedSeederClasses->sortBy(function ($seederFullClassName) {
                // get the order number form the end of each class name
                $orderNumber = substr($seederFullClassName, strpos($seederFullClassName, "_") + 1);

                return $orderNumber;
            });

            // append the randomly ordered seeder classes to the end of the ordered seeder classes
            foreach ($seedersClasses as $seederClass) {
                $orderedSeederClasses->push($seederClass);
            }

            return $orderedSeederClasses;
        }

    }

    /**
     * @param $seedersClasses
     */
    private function loadSeeders($seedersClasses)
    {
        foreach ($seedersClasses as $seeder) {
            // seed it with call
            $this->call($seeder);
        }
    }

}
