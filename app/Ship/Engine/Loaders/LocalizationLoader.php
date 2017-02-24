<?php

namespace App\Ship\Engine\Loaders;

use App\Ship\Engine\Butlers\Facades\ShipButler;
use Illuminate\Translation\FileLoader;
use Illuminate\Translation\TranslationServiceProvider as LaravelTranslationServiceProvider;

/**
 * Class LocalizationServiceProvider.
 *
 * Extending the default Laravel Localization Loader to allow loading from multiple directories
 *
 * @author  Mahmoud Zalt <mahmoud@zalt.me>
 */
class LocalizationLoader extends LaravelTranslationServiceProvider
{

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        parent::register();

        $paths = [
            // first add the default laravel lang directory path
            $this->app['path.lang']
        ];

        // second append all the containers languages paths to the array
        foreach (ShipButler::getContainersNames() as $containerName) {
            $paths[] = app_path() . "/Containers/{$containerName}/Resources/Languages";
        }

        $this->app->singleton('translation.loader', function ($app) use ($paths){
            return new FileLoader($app['files'], $paths);
        });
    }

}
