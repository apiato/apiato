<?php

namespace App\Port\Routes\Traits;

use App\Port\Butler\Portals\Facade\PortButler;
use Dingo\Api\Routing\Router as DingoApiRouter;
use Illuminate\Routing\Router as LaravelRouter;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\File;
use Symfony\Component\Finder\SplFileInfo;

/**
 * Class RoutesServiceProviderTrait.
 *
 * @author  Mahmoud Zalt <mahmoud@zalt.me>
 */
trait RoutesServiceProviderTrait
{

    /**
     * Register all the containers routes files in the framework
     */
    private function registerRoutes()
    {
        $containersPaths = PortButler::getContainersPaths();
        $containersNamespace = PortButler::getContainersNamespace();

        foreach ($containersPaths as $containerPath) {
            $this->registerContainersApiRoutes($containerPath, $containersNamespace);
            $this->registerContainersWebRoutes($containerPath, $containersNamespace);
        }
    }

    /**
     * Register the Containers API routes files
     *
     * @param $containerPath
     * @param $containersNamespace
     */
    private function registerContainersApiRoutes($containerPath, $containersNamespace)
    {
        // get the container api routes path
        $apiRoutesPath = $containerPath . '/UI/API/Routes';

        if (File::isDirectory($apiRoutesPath)) {

            // get all files from the container API routes directory
            $files = File::allFiles($apiRoutesPath);

            foreach ($files as $file) {

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
                            'limit'      => Config::get('api.limit'),
                            // The API limit expiry time.
                            'expires'    => Config::get('api.limit_expires'),
                        ], function ($router) use ($file) {

                            require $file->getPathname();

                        });

                    });

            }

        }
    }

    /**
     * Register the Containers WEB routes files
     *
     * @param $containerPath
     * @param $containersNamespace
     */
    private function registerContainersWebRoutes($containerPath, $containersNamespace)
    {
        // get the container web routes path
        $webRoutesPath = $containerPath . '/UI/WEB/Routes';

        if (File::isDirectory($webRoutesPath)) {
            // get all files from the container Web routes directory
            $files = File::allFiles($webRoutesPath);

            $controllerNamespace = $containersNamespace . '\\Containers\\' . basename($containerPath) . '\\UI\WEB\Controllers';

            foreach ($files as $file) {
                $this->webRouter->group([
                    'middleware' => ['web'],
                    'namespace'  => $controllerNamespace,
                ], function (LaravelRouter $router) use ($file) {
                    require $file->getPathname();
                });
            }
        }

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

    /**
     * @param $fileNameWithoutExtension
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

}
