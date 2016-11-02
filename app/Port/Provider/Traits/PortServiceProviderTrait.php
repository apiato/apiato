<?php

namespace App\Port\Provider\Traits;

use App;
use App\Port\Butler\Portals\Facade\PortButler;
use App\Port\Exception\Exceptions\UnsupportedFractalSerializerException;
use DB;
use File;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\View;
use Log;

/**
 * Class PortServiceProviderTrait.
 *
 * @author  Mahmoud Zalt <mahmoud@zalt.me>
 */
trait PortServiceProviderTrait
{

    /**
     * Write the DB queries in the Log and Display them in the
     * terminal (in case you want to see them while executing the tests).
     *
     * @param bool|false $terminal
     */
    public function debugDatabaseQueries($log = true, $terminal = false)
    {
        if (Config::get('database.query_debugging')) {
            DB::listen(function ($event) use ($terminal, $log) {
                $fullQuery = vsprintf(str_replace(['%', '?'], ['%%', '%s'], $event->sql), $event->bindings);

                $text = $event->connectionName . ' (' . $event->time . '): ' . $fullQuery;

                if ($terminal) {
                    dump($text);
                }

                if ($log) {
                    Log::info($text);
                }
            });
        }
    }

    /**
     * By default Laravel takes (server/database/factories) as the
     * path to the factories, this function changes the path to load
     * the factories from the infrastructure directory.
     */
    public function changeTheDefaultDatabaseModelsFactoriesPath($customPath)
    {
        App::singleton(\Illuminate\Database\Eloquent\Factory::class, function ($app) use ($customPath) {
            $faker = $app->make(\Faker\Generator::class);

            return \Illuminate\Database\Eloquent\Factory::construct($faker, base_path() . $customPath);
        });
    }

    /**
     * Get the containers Service Providers full classes names.
     *
     * @return  array
     */
    public function getMainServiceProviders()
    {
        $containersNamespace = PortButler::getContainersNamespace();

        $allServiceProviders = [];

        foreach (PortButler::getContainersNames() as $containerName) {
            // append the Module main service provider
            $allServiceProviders[] = PortButler::buildMainServiceProvider($containersNamespace, $containerName);
        }

        return array_unique($allServiceProviders) ? : [];
    }

    /**
     * Load views from inside the Containers
     */
    public function autoLoadViewsFromContainers()
    {
        foreach (PortButler::getContainersNames() as $containerName) {

            $containerViewDirectory = base_path('app/Containers/' . $containerName . '/UI/WEB/Views/');

            if (File::isDirectory($containerViewDirectory)) {
                View::addLocation($containerViewDirectory);
            }
        }
    }

    /**
     * Load migrations files from Containers to Laravel
     */
    public function autoMigrationsFromContainers()
    {
        foreach (PortButler::getContainersNames() as $containerName) {

            $containerMigrationDirectory = base_path('app/Containers/' . $containerName . '/Data/Migrations');

            if (File::isDirectory($containerMigrationDirectory)) {

                App::afterResolving('migrator', function ($migrator) use ($containerMigrationDirectory) {
                    foreach ((array)$containerMigrationDirectory as $path) {
                        $migrator->path($path);
                    }
                });
            }
        }
    }

    /**
     * Auto load Containers and Port config files into Laravel
     */
    public function autoLoadConfigFiles()
    {
        $this->autoLoadContainersConfigFiles();
        $this->autoLoadPortConfigFiles();
    }

    /**
     *
     */
    protected function autoLoadContainersConfigFiles()
    {
        foreach (PortButler::getContainersNames() as $containerName) {
            $this->loadConfigs(base_path('app/Containers/' . $containerName . '/Configs'));
        }
    }

    /**
     *
     */
    protected function autoLoadPortConfigFiles()
    {
        $this->loadConfigs(base_path('app/Port/Configs'));
    }

    /**
     * @param $directory
     */
    private function loadConfigs($directory)
    {
        if (File::isDirectory($directory)) {

            $files = File::allFiles($directory);

            foreach ($files as $file) {
                // build the key from the file name (just remove the .php extension from the file name)
                $fileNameOnly = str_replace('.php', '', $file->getFilename());

                // merge the config file
                $this->mergeConfigFrom($file->getPathname(), $fileNameOnly);
            }
        }
    }


    /**
     * By default the Dingo API package (in the config file) creates an instance of the
     * fractal manager which takes the default serializer (specified by the fractal
     * package itself, and there's no way to override change it from the configurations of
     * the Dingo package).
     *
     * Here I am replacing the current default serializer (DataArraySerializer) by the
     * (JsonApiSerializer).
     *
     * "Serializers are what build the final response after taking the transformers data".
     */
    public function overrideDefaultFractalSerializer()
    {
        $serializerName = Config::get('api.serializer');

        // if DataArray `\League\Fractal\Serializer\DataArraySerializer` do noting since it's set by default by the Dingo API
        if ($serializerName !== 'DataArray') {
            app('Dingo\Api\Transformer\Factory')->setAdapter(function () use ($serializerName) {
                switch ($serializerName) {
                    case 'JsonApi':
                        $serializer = new \League\Fractal\Serializer\JsonApiSerializer(Config::get('api.domain'));
                        break;
                    case 'Array':
                        $serializer = new \League\Fractal\Serializer\ArraySerializer(Config::get('api.domain'));
                        break;
                    default:
                        throw new UnsupportedFractalSerializerException('Unsupported ' . $serializerName);
                }

                $fractal = new \League\Fractal\Manager();
                $fractal->setSerializer($serializer);

                return new \Dingo\Api\Transformer\Adapter\Fractal($fractal, 'include', ',', false);
            });
        }
    }
}
