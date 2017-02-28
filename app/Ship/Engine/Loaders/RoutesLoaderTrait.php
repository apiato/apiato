<?php

namespace App\Ship\Engine\Loaders;

use App\Ship\Engine\Butlers\Facades\ShipButler;
use Dingo\Api\Routing\Router as DingoApiRouter;
use Illuminate\Routing\Router as LaravelRouter;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\File;
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
            $this->loadRoutesFromContainersForApi($containerPath, $containersNamespace);
            $this->loadRoutesFromContainersForWeb($containerPath, $containersNamespace);
        }
    }

    /**
     * Register the Containers API routes files
     *
     * @param $containerPath
     * @param $containersNamespace
     */
    private function loadRoutesFromContainersForApi($containerPath, $containersNamespace)
    {
        // get the container api routes path
        $apiRoutesPath = $containerPath . '/UI/API/Routes';

        if (File::isDirectory($apiRoutesPath)) {
            // get all files from the container API routes directory
            $files = File::allFiles($apiRoutesPath);

            foreach ($files as $file) {
                $this->loadApiRoute($file, $containerPath, $containersNamespace);
            }
        }
    }

    /**
     * Register the Containers WEB routes files
     *
     * @param $containerPath
     * @param $containersNamespace
     */
    private function loadRoutesFromContainersForWeb($containerPath, $containersNamespace)
    {
        // get the container web routes path
        $webRoutesPath = $containerPath . '/UI/WEB/Routes';

        if (File::isDirectory($webRoutesPath)) {
            // get all files from the container Web routes directory
            $files = File::allFiles($webRoutesPath);

            $controllerNamespace = $containersNamespace . '\\Containers\\' . basename($containerPath) . '\\UI\WEB\Controllers';

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
        $this->webRouter->group([
            'middleware' => ['web'],
            'namespace'  => $controllerNamespace,
        ], function (LaravelRouter $router) use ($file) {
            require $file->getPathname();
        });
    }

    /**
     * @param $file
     * @param $containerPath
     * @param $containersNamespace
     */
    private function loadApiRoute($file, $containerPath, $containersNamespace)
    {
        // get the version from the file name to register it
        $apiVersionNumber = $this->getRouteFileVersionNumber($file);

        $this->apiRouter->version('v' . $apiVersionNumber,
            function (DingoApiRouter $router) use ($file, $containerPath, $containersNamespace) {

                $controllerNamespace = $containersNamespace . '\\Containers\\' . basename($containerPath) . '\\UI\API\Controllers';

                $router->group([
                    // Routes Namespace
                    'namespace'  => $controllerNamespace,
                    // Add Middleware's - 'api' is a group of middleware's
                    'middleware' => ['api'],
                    // The API limit time.
                    'limit'      => Config::get('hello.api.limit'),
                    // The API limit expiry time.
                    'expires'    => Config::get('hello.api.limit_expires'),
                ], function ($router) use ($file) {

                    require $file->getPathname();

                });

            });
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
