<?php

namespace App\Kernel\Configuration\Portals;

use App\Kernel\Configuration\Exceptions\WrongConfigurationsException;
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
     * @param $containerName
     *
     * @return  mixed
     */
    public function getContainersExtraServiceProviders($containerName)
    {
        $configurations = Config::get('megavel.containers.register.' . $containerName . '.extraServiceProviders');

        if (is_null($configurations)) {
            $configurations = [];
        }

        return $configurations;
    }

    /**
     * build the main service provider class namespace
     *
     * @param $containersNamespace
     * @param $containerName
     *
     * @return  string
     */
    public function buildMainServiceProvider($containersNamespace, $containerName)
    {
        if($containerName != 'Kernel') {
            return $containersNamespace . "\\Containers\\" . $containerName . "\\Providers\\" . $containerName . "ServiceProvider";
        }

        return "App" . "\\Kernel" . "\\Provider\\Providers\\" . $containerName . "ServiceProvider";
    }

    /**
     * Get the containers web routes values from the containers config file
     *
     * @param $containerName
     *
     * @return  mixed
     */
    public function getContainersWebRoutes($containerName)
    {
        $configurations = Config::get('megavel.containers.register.' . $containerName . '.routes.web');

        if (is_null($configurations)) {
            $configurations = [];
        }

        return $configurations;
    }

    /**
     * Get the containers api routes values from the containers config file
     *
     * @param $containerName
     *
     * @return  mixed
     */
    public function getContainersApiRoutes($containerName)
    {
        $configurations = Config::get('megavel.containers.register.' . $containerName . '.routes.api');

        if (is_null($configurations)) {
            $configurations = [];
        }

        return $configurations;
    }
}
