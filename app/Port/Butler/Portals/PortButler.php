<?php

namespace App\Port\Butler\Portals;

use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\File;

/**
 * Class PortButler.
 *
 * NOTE: You can access this Class functions with the facade [ModuleConfig].
 *
 * @author Mahmoud Zalt <mahmoud@zalt.me>
 */
class PortButler
{

    /**
     * Get the containers namespace value from the containers config file
     *
     * @return  string
     */
    public function getContainersNamespace()
    {
        return Config::get('csap.containers.namespace');
    }

    /**
     * Get the containers names
     *
     * @return  array
     */
    public function getContainersNames()
    {
        $containersNames = [];

        foreach($this->getContainersPaths() as $containersPath){
            $containersNames[] = basename($containersPath);
        }

        return $containersNames;
    }

    /**
     * get containers directories paths
     *
     * @return  mixed
     */
    public function getContainersPaths()
    {
        return File::directories(app_path('Containers'));
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
        if($containerName != 'Port') {
            return $containersNamespace . "\\Containers\\" . $containerName . "\\Settings\\Providers\\" . $containerName . "ServiceProvider";
        }

        return "App" . "\\Port" . "\\Provider\\Providers\\" . $containerName . "ServiceProvider";
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
        $configurations = Config::get('csap.containers.register.' . $containerName . '.routes.web');

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
        $configurations = Config::get('csap.containers.register.' . $containerName . '.routes.api');

        if (is_null($configurations)) {
            $configurations = [];
        }

        return $configurations;
    }

}
