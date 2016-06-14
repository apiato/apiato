<?php

namespace Hello\Services\Configuration\Portals;

use Hello\Services\Configuration\Exceptions\WrongConfigurationsException;
use Illuminate\Support\Facades\Config;

/**
 * Class ModulesConfigReaderService.
 *
 * NOTE: You can access this Class functions with the facade [ModuleConfig].
 *
 * @author Mahmoud Zalt <mahmoud@zalt.me>
 */
class ModulesConfigReaderService
{

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
     * Get the registered modules names in the modules config file
     *
     * @return  array
     */
    public function getModulesNames()
    {
        $configurations = Config::get('modules.modules.register');

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
    public function getModulesExtraServiceProviders($moduleName)
    {
        $configurations = Config::get('modules.modules.register.' . $moduleName . '.extraServiceProviders');

        if (is_null($configurations)) {
            $configurations = [];
        }

        return $configurations;
    }

    /**
     * build the main service provider class namespace
     *
     * @param $modulesNamespace
     * @param $moduleName
     *
     * @return  string
     */
    public function buildMainServiceProvider($modulesNamespace, $moduleName)
    {
        if($moduleName != 'Core') {
            return $modulesNamespace . "\\Modules\\" . $moduleName . "\\Providers\\" . $moduleName . "ServiceProvider";
        }

        return $modulesNamespace . "\\Modules\\" . $moduleName . "\\Provider\\Providers\\" . $moduleName . "ServiceProvider";
    }

    /**
     * Get the Models Factory Path from the modules config file
     *
     * @return  mixed
     */
    public function getModelsFactoryPath()
    {
        return Config::get('modules.modelsFactoryPath');
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
        $configurations = Config::get('modules.modules.register.' . $moduleName . '.routes.web');

        if (is_null($configurations)) {
            $configurations = [];
        }

        return $configurations;
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
        $configurations = Config::get('modules.modules.register.' . $moduleName . '.routes.api');

        if (is_null($configurations)) {
            $configurations = [];
        }

        return $configurations;
    }
}
