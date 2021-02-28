<?php

namespace Apiato\Core\Loaders;

trait ConfigsLoaderTrait
{
    public function loadConfigsFromShip(): void
    {
        $portConfigsDirectory = base_path('app/Ship/Configs');

        $this->loadConfigs($portConfigsDirectory);
    }

    private function loadConfigs($configFolder, $namespace = null): void
    {
        $files = $this->app['files']->files($configFolder);
        $namespace = $namespace ? $namespace . '::' : '';

        foreach ($files as $file) {
            $config = $this->app['files']->getRequire($file);
            $name = $this->app['files']->name($file);

            // special case for files named config.php (config keyword is omitted)
            if ($name === 'config') {
                foreach ($config as $key => $value) {
                    $this->app['config']->set($namespace . $key, $value);
                }
            }

            $this->app['config']->set($namespace . $name, $config);
        }
    }

    public function loadConfigsFromContainers($containerName): void
    {
        $containerConfigsDirectory = base_path('app/Containers/' . $containerName . '/Configs');

        $this->loadConfigs($containerConfigsDirectory);
    }
}
