<?php

namespace Hello\Services\Configuration\Portals;

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

}
