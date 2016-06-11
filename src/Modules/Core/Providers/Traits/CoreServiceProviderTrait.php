<?php

namespace Hello\Modules\Core\Providers\Traits;

use App;
use DB;
use Hello\Modules\Core\Exception\Exceptions\MissingConfigurationsException;
use Hello\Modules\Core\Exception\Exceptions\UnsupportedFractalSerializerException;
use Illuminate\Support\Facades\Config;
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
            $this->app->register($provider);
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
    public function changeTheDefaultDatabaseModelsFactoriesPath()
    {
        $customPath = Config::get('modules.modelsFactoryPath');

        $this->app->singleton(\Illuminate\Database\Eloquent\Factory::class, function ($app) use ($customPath) {
            $faker = $app->make(\Faker\Generator::class);

            return \Illuminate\Database\Eloquent\Factory::construct($faker, base_path() . $customPath);
        });
    }

    /**
     * register the Migrations to be published when this command runs
     * `php artisan vendor:publish --provider="Hello\Infrastructure\Providers\CoreServiceProvider"`.
     *
     * This transfers all the Migrations files from the Infrastructure directory to the Framework
     * Migrations Directory.
     *
     * @param $directory
     */
    public function registerTheDatabaseMigrationsFiles($directory)
    {
        $this->publishes([
            $directory . '/../Migrations/MySQL/' => database_path('migrations'),
        ], 'migrations');
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
     * Get the registered modules names in the modules config file
     *
     * @return  array
     */
    public function getModulesNames()
    {
        $configurations = Config::get('modules.modules.register');

        if (is_null($configurations)) {
            throw new MissingConfigurationsException();
        }

        return array_keys($configurations);
    }

    /**
     * Get the modules namespace value from the modules config file
     *
     * @return  string
     */
    public function getModulesNamespace()
    {
        return Config::get('modules.modules.namespace');
    }

    /**
     * Get the modules api routes values from the modules config file
     *
     * @param $moduleName
     *
     * @return  mixed
     */
    public function getModulesApiRoutes($moduleName)
    {
        return Config::get('modules.modules.register.' . $moduleName . '.routes.api');
    }

    /**
     * Get the modules web routes values from the modules config file
     *
     * @param $moduleName
     *
     * @return  mixed
     */
    public function getModulesWebRoutes($moduleName)
    {
        return Config::get('modules.modules.register.' . $moduleName . '.routes.web');
    }

    /**
     * Get the Service Providers full classes names from the modules config file registered modules.
     *
     * @return  array
     */
    public function getModulesServiceProviders()
    {
        return $this->buildServiceProviderClassNamespace($this->getModulesNames(), $this->getModulesNamespace());
    }

    /**
     * Build the full name of the class of the Service Providers.
     *
     * @param array $modulesNames
     * @param       $modulesNamespace
     *
     * @return  array
     */
    private function buildServiceProviderClassNamespace(array $modulesNames, $modulesNamespace)
    {
        $modulesClasses = [];

        foreach ($modulesNames as $moduleName) {
            $modulesClasses[] = $modulesNamespace . "\\Modules\\" . $moduleName . "\\Providers\\" . $moduleName . "ServiceProvider";
        }

        return $modulesClasses;
    }

}
