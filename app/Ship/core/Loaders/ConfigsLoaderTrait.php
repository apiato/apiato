<?php

namespace Apiato\Core\Loaders;


use Illuminate\Contracts\Filesystem\FileNotFoundException;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\File;

trait ConfigsLoaderTrait
{
    public function loadConfigsFromShip(): void
    {
        $portConfigsDirectory = base_path('app/Ship/Configs');

        $this->loadConfigs($portConfigsDirectory);
    }

    private function loadConfigs($configFolder, $namespace = null): void
    {
        $files = File::files($configFolder);
        $namespace = $namespace ? $namespace . '::' : '';

        foreach ($files as $file) {
            try {
                $config = File::getRequire($file);
                $name = File::name($file);

                // special case for files named config.php (config keyword is omitted)
                if ($name === 'config') {
                    foreach ($config as $key => $value) {
                        Config::set($namespace . $key, $value);
                    }
                }

                Config::set($namespace . $name, $config);
            } catch (FileNotFoundException $e) {
            }
        }
    }

    public function loadConfigsFromContainers($containerName): void
    {
        $containerConfigsDirectory = base_path('app/Containers/' . $containerName . '/Configs');

        $this->loadConfigs($containerConfigsDirectory);
    }
}
