<?php

namespace Apiato\Core\Traits;

use Illuminate\Database\Eloquent\Factories\Factory;

trait FactoryLocatorTrait
{
    protected static function newFactory(): Factory
    {
        $containersFactoriesPath = DIRECTORY_SEPARATOR . 'Data' . DIRECTORY_SEPARATOR . 'Factories' . DIRECTORY_SEPARATOR;
        $containerName = explode(DIRECTORY_SEPARATOR, static::class)[2];
        $nameSpace = 'App' . DIRECTORY_SEPARATOR . 'Containers' . DIRECTORY_SEPARATOR . $containerName . $containersFactoriesPath;

        Factory::useNamespace($nameSpace);
        $className = class_basename(static::class);
        return Factory::factoryForModel($className);
    }
}
