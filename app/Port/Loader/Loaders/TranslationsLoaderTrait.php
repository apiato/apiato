<?php

namespace App\Port\Loader\Loaders;

use File;
use Illuminate\Translation\Translator;

/**
 * Class TranslationsLoaderTrait.
 *
 * @author  Mahmoud Zalt <mahmoud@zalt.me>
 */
trait TranslationsLoaderTrait
{

    /**
     * loadTranslationsFromContainers
     */
    public function loadTranslationsFromContainers($containerName)
    {
        $containerLangDirectory = base_path('app/Containers/' . $containerName . '/Lang');

        $this->loadTranslations($containerLangDirectory, $containerName);
    }

    /**
     * @param $directory
     */
    private function loadTranslations($directory, string $containerName = '')
    {
        if (File::isDirectory($directory)) {
            app()->make('translator')->addNamespace(camel_case($containerName), $directory);
        }
    }

}
