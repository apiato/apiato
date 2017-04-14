<?php

namespace App\Ship\Engine\Loaders;

use App\Ship\Engine\Butlers\Facades\ShipButler;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Route;
use Symfony\Component\Finder\SplFileInfo;

/**
 * Class RoutesLoaderTrait.
 *
 * @author  Mahmoud Zalt <mahmoud@zalt.me>
 */
trait RoutesLoaderTrait
{

    /**
     * Register all the containers routes files in the framework
     */
    public function runRoutesAutoLoader()
    {
        $containersPaths = ShipButler::getContainersPaths();
        $containersNamespace = ShipButler::getContainersNamespace();

        foreach ($containersPaths as $containerPath) {
            $this->loadApiContainerRoutes($containerPath, $containersNamespace);
            $this->loadWebContainerRoutes($containerPath, $containersNamespace);
        }
    }

    /**
     * Register the Containers API routes files
     *
     * @param $containerPath
     * @param $containersNamespace
     */
    private function loadApiContainerRoutes($containerPath, $containersNamespace)
    {
        // build the container api routes path
        $apiRoutesPath = $containerPath . '/UI/API/Routes';
        // build the namespace from the path
        $controllerNamespace = $containersNamespace . '\\Containers\\' . basename($containerPath) . '\\UI\API\Controllers';

        if (File::isDirectory($apiRoutesPath)) {
            $files = File::allFiles($apiRoutesPath);
            foreach ($files as $file) {
                $this->loadApiRoute($file, $controllerNamespace);
            }
        }
    }

    /**
     * Register the Containers WEB routes files
     *
     * @param $containerPath
     * @param $containersNamespace
     */
    private function loadWebContainerRoutes($containerPath, $containersNamespace)
    {
        // build the container web routes path
        $webRoutesPath = $containerPath . '/UI/WEB/Routes';
        // build the namespace from the path
        $controllerNamespace = $containersNamespace . '\\Containers\\' . basename($containerPath) . '\\UI\WEB\Controllers';

        if (File::isDirectory($webRoutesPath)) {
            $files = File::allFiles($webRoutesPath);
            foreach ($files as $file) {
                $this->loadWebRoute($file, $controllerNamespace);
            }
        }
    }

    /**
     * @param $file
     * @param $controllerNamespace
     */
    private function loadWebRoute($file, $controllerNamespace)
    {
        Route::group([
            'namespace'  => $controllerNamespace,
            'middleware' => ['web'],
        ], function ($router) use ($file) {
            require $file->getPathname();
        });
    }

    /**
     * @param $file
     * @param $controllerNamespace
     */
    private function loadApiRoute($file, $controllerNamespace)
    {
        $rateLimitMiddleware = 'throttle:' . Config::get('apiato.api.throttle_attempts') . ',' . Config::get('apiato.api.throttle_expires');

        $versionPrefix = '/' . $this->getRouteFileVersionFromFileName($file);

        Route::group([
            'namespace'  => $controllerNamespace,
            'middleware' => ['api', $rateLimitMiddleware],
            'domain'     => Config::get('apiato.api.url'),
            'prefix'     => $versionPrefix,
        ], function ($router) use ($file) {
            require $file->getPathname();
        });
    }


    /**
     * @param $file
     *
     * @return  mixed
     */
    private function getRouteFileVersionFromFileName($file)
    {
        $fileNameWithoutExtension = $this->getRouteFileNameWithoutExtension($file);

        $fileNameWithoutExtensionExploded = explode('.', $fileNameWithoutExtension);

        end($fileNameWithoutExtensionExploded);

        $apiVersion = prev($fileNameWithoutExtensionExploded); // get the array before the last one

        // Skip versioning the API's root route
        if($apiVersion === 'ApisRoot'){
            $apiVersion = '';
        }

        return $apiVersion;
    }

    /**
     * @param \Symfony\Component\Finder\SplFileInfo $file
     *
     * @return  mixed
     */
    private function getRouteFileNameWithoutExtension(SplFileInfo $file)
    {
        $fileInfo = pathinfo($file->getFileName());

        return $fileInfo['filename'];
    }
}
