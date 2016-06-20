<?php

namespace App\Services\Configuration\Portals;

use App\Services\Configuration\Exceptions\WrongConfigurationsException;
use Illuminate\Support\Facades\Config;

/**
 * Class MegavelConfigReaderService.
 *
 * NOTE: You can access this Class functions with the facade [ModuleConfig].
 *
 * @author Mahmoud Zalt <mahmoud@zalt.me>
 */
class MegavelConfigReaderService
{

    /**
     * Get the containers namespace value from the containers config file
     *
     * @return  string
     */
    public function getContainersNamespace()
    {
        return Config::get('megavel.containers.namespace');
    }

    /**
     * Get the registered containers names in the containers config file
     *
     * @return  array
     */
    public function getContainersNames()
    {
        $configurations = Config::get('megavel.containers.register');

        if (is_null($configurations)) {
            throw new WrongConfigurationsException();
        }

        return array_keys($configurations);
    }

    /**
     * Get the extraServiceProviders of a Module
     *
     * @param $moduleName
     *
     * @return  mixed
     */
    public function getContainersExtraServiceProviders($moduleName)
    {
        $configurations = Config::get('megavel.containers.register.' . $moduleName . '.extraServiceProviders');

        if (is_null($configurations)) {
            $configurations = [];
        }

        return $configurations;
    }

    /**
     * build the main service provider class namespace
     *
     * @param $containersNamespace
     * @param $moduleName
     *
     * @return  string
     */
    public function buildMainServiceProvider($containersNamespace, $moduleName)
    {
        if($moduleName != 'Kernel') {
            return $containersNamespace . "\\Containers\\" . $moduleName . "\\Providers\\" . $moduleName . "ServiceProvider";
        }

        return "App" . "\\Kernel" . "\\Provider\\Providers\\" . $moduleName . "ServiceProvider";
    }

    /**
     * Get the containers web routes values from the containers config file
     *
     * @param $moduleName
     *
     * @return  mixed
     */
    public function getContainersWebRoutes($moduleName)
    {
        $configurations = Config::get('megavel.containers.register.' . $moduleName . '.routes.web');

        if (is_null($configurations)) {
            $configurations = [];
        }

        return $configurations;
    }

    /**
     * Get the containers api routes values from the containers config file
     *
     * @param $moduleName
     *
     * @return  mixed
     */
    public function getContainersApiRoutes($moduleName)
    {
        $configurations = Config::get('megavel.containers.register.' . $moduleName . '.routes.api');

        if (is_null($configurations)) {
            $configurations = [];
        }

        return $configurations;
    }
}
