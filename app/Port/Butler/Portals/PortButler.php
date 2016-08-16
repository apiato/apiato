<?php

namespace App\Port\Butler\Portals;

use App\Port\Butler\Exceptions\WrongConfigurationsException;
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
        return Config::get('hello.containers.namespace');
    }

    /**
     * @return  mixed
     */
    public function getLoginWebPageName()
    {
        $loginPage = Config::get('hello.containers.login-page-name');

        if (is_null($loginPage)) {
            throw new WrongConfigurationsException();
        }

        return $loginPage;
    }

    /**
     * Get the containers names
     *
     * @return  array
     */
    public function getContainersNames()
    {
        $containersNames = [];

        foreach ($this->getContainersPaths() as $containersPath) {
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
        if ($containerName != 'Port') {
            return $containersNamespace . "\\Containers\\" . $containerName . "\\Providers\\" . $containerName . "ServiceProvider";
        }

        return "App" . "\\Port" . "\\Provider\\Providers\\" . $containerName . "ServiceProvider";
    }


}
