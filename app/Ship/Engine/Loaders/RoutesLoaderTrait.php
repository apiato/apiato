<?php

namespace App\Ship\Engine\Loaders;

use App\Ship\Engine\Butlers\Facades\ShipButler;
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
        Route::middleware('web')
            ->namespace($controllerNamespace)
            ->group($file->getPathname());

//        $this->webRouter->group([
//            'middleware' => ['web'],
//            'namespace'  => $controllerNamespace,
//        ], function (LaravelRouter $router) use ($file) {
//            require $file->getPathname();
//        });
    }

    /**
     * @param $file
     * @param $controllerNamespace
     */
    private function loadApiRoute($file, $controllerNamespace)
    {
        // get the version from the file name to register it
//        $apiVersionNumber = $this->getRouteFileVersionNumber($file); // TODO: use the api version

        // The API limit time.
//        'limit'      => Config::get('apiato.api.limit'),
        // The API limit expiry time.
//        'expires'    => Config::get('apiato.api.limit_expires'),

        // TODO for subdomain try this:
//        Route::group([
//            // Routes Namespace
//            'namespace' => $controllerNamespace,
//            // Add Middleware's - 'api' is a group of middleware's
//            'middleware' => ['api'],
//            // Add Domain - only for API domain
//            'domain' => 'api.'.env('APP_URL'),
//        ], function ($router) use ($file) {
//            require $file->getPathname();
//        });

        Route::prefix('api') // TODO: remove this and replace it back with subdomain
            ->middleware('api')
            ->namespace($controllerNamespace)
            ->group($file->getPathname());
    }


    /**
     * @param $file
     *
     * @return  int
     */
    private function getRouteFileVersionNumber($file)
    {
        $fileNameWithoutExtension = $this->getRouteFileNameWithoutExtension($file);

        $fileNameWithoutExtensionExploded = explode('.', $fileNameWithoutExtension);

        end($fileNameWithoutExtensionExploded);
        $apiVersion = prev($fileNameWithoutExtensionExploded); // get the array before the last one

        $apiVersionNumber = str_replace('v', '', $apiVersion);

        return (is_int($apiVersionNumber) ? $apiVersionNumber : 1);
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
