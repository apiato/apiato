<?php

namespace App\Port\Provider\Traits;

use App;
use App\Port\Butler\Portals\Facade\PortButler;
use App\Port\Exception\Exceptions\UnsupportedFractalSerializerException;
use DB;
use Illuminate\Support\Facades\Config;
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
            DB::listen(function ($query, $bindings, $time, $connection) use ($terminal, $log) {
                $fullQuery = vsprintf(str_replace(['%', '?'], ['%%', '%s'], $query), $bindings);

                $text = $connection . ' (' . $time . '): ' . $fullQuery;

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
        $this->app->singleton(\Illuminate\Database\Eloquent\Factory::class, function ($app) use ($customPath) {
            $faker = $app->make(\Faker\Generator::class);

            return \Illuminate\Database\Eloquent\Factory::construct($faker, base_path() . $customPath);
        });
    }

    /**
     * Register the Migrations files of all Containers
     */
    public function publishContainersMigrationsFiles()
    {
        foreach (PortButler::getContainersNames() as $containerName) {
            $this->publishModuleMigrationsFiles($containerName);
        }
    }

    /**
     * Get the Service Providers full classes names from the containers config file registered containers.
     *
     * @return  array
     */
    public function getContainersServiceProviders()
    {
        $containersNamespace = PortButler::getContainersNamespace();

        foreach (PortButler::getContainersNames() as $containerName) {
            // append the Module main service provider
            $allServiceProviders[] = PortButler::buildMainServiceProvider($containersNamespace, $containerName);
        }

        return array_unique($allServiceProviders) ? : [];
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


    /**
     * Register the Migrations files of a Module
     *
     * This transfers all the Migrations files from the Module directory to the Framework
     * Migrations Directory.
     *
     * @param $directory
     */
    private function publishModuleMigrationsFiles($containerName)
    {
        $containerMigrationsDirectory = base_path() . '/app/Containers/' . $containerName . '/Migrations/';

        if (is_dir($containerMigrationsDirectory)) {
            $this->publishes([
                $containerMigrationsDirectory => database_path('migrations'),
            ], 'migrations');
        }
    }

}
