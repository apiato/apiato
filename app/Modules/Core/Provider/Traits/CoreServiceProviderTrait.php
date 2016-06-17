<?php

namespace App\Modules\Core\Provider\Traits;

use App;
use App\Services\Configuration\Portals\Facade\ModulesConfig;
use App\Services\Exceptions\UnsupportedFractalSerializerException;
use DB;
use Log;

/**
 * Class CoreServiceProviderTrait.
 *
 * @author  Mahmoud Zalt <mahmoud@zalt.me>
 */
trait CoreServiceProviderTrait
{

    /**
     * register an array of providers.
     *
     * @param array $providers
     */
    public function registerServiceProviders(array $providers)
    {
        foreach ($providers as $provider) {
            if (class_exists($provider)) {
                $this->app->register($provider);
            }
        }
    }

    /**
     * @param bool|false $terminal
     */
    public function debugDatabaseQueries($terminal = false)
    {
        if (env('DATABASE_QUERIES_DEBUG', false)) {
            DB::listen(function ($query, $bindings, $time, $connection) use ($terminal) {
                $fullQuery = vsprintf(str_replace(['%', '?'], ['%%', '%s'], $query), $bindings);

                $text = $connection . ' (' . $time . '): ' . $fullQuery;

                if ($terminal) {
                    dump($text);
                }

                Log::info($text);
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
     * Register the Migrations files of all Modules
     */
    public function publishModulesMigrationsFiles()
    {
        foreach (ModulesConfig::getModulesNames() as $moduleName) {
            $this->publishModuleMigrationsFiles($moduleName);
        }
    }

    /**
     * Get the Service Providers full classes names from the modules config file registered modules.
     *
     * @return  array
     */
    public function getModulesServiceProviders()
    {
        $modulesNamespace = ModulesConfig::getModulesNamespace();

        foreach (ModulesConfig::getModulesNames() as $moduleName) {
            // get the Module extra service providers (extra service providers are defined in the modules config file)
            foreach (ModulesConfig::getModulesExtraServiceProviders($moduleName) as $provider) {
                $allServiceProviders[] = $provider;
            }
            // append the Module main service provider
            $allServiceProviders[] = ModulesConfig::buildMainServiceProvider($modulesNamespace, $moduleName);
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
        $serializerName = env('FRACTAL_SERIALIZER', 'DataArray');

        // if DataArray `\League\Fractal\Serializer\DataArraySerializer` do noting since it's set by default by the Dingo API
        if ($serializerName !== 'DataArray') {
            app('Dingo\Api\Transformer\Factory')->setAdapter(function () use ($serializerName) {
                switch ($serializerName) {
                    case 'JsonApi':
                        $serializer = new \League\Fractal\Serializer\JsonApiSerializer(env('API_DOMAIN'));
                        break;
                    case 'Array':
                        $serializer = new \League\Fractal\Serializer\ArraySerializer(env('API_DOMAIN'));
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
    private function publishModuleMigrationsFiles($moduleName)
    {
        $moduleMigrationsDirectory = base_path() . '/app/Modules/' . $moduleName . '/Migrations/';

        if (is_dir($moduleMigrationsDirectory)) {
            $this->publishes([
                $moduleMigrationsDirectory => database_path('migrations'),
            ], 'migrations');
        }
    }

}
