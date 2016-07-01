<?php

namespace App\Kernel\Routes\Traits;

use App\Kernel\Configuration\Portals\Facade\MegavelConfig;
use Dingo\Api\Routing\Router as DingoApiRouter;
use Illuminate\Routing\Router as LaravelRouter;
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
        $containersPaths = FIle::directories(app_path('Containers'));
        $containersNamespace = MegavelConfig::getContainersNamespace();

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
        $apiRoutesPath = $containerPath . '/Routes/Api';

        if (File::isDirectory($apiRoutesPath)) {

            // get all files from the container API routes directory
            $files = File::allFiles($apiRoutesPath);

            foreach ($files as $file) {

                $fileNameWithoutExtension = $this->getRouteFileNameWithoutExtension($file);

                $apiVersionNumber = $this->getRouteFileVersionNumber($fileNameWithoutExtension);

                $this->apiRouter->version('v' . $apiVersionNumber,
                    function (DingoApiRouter $router) use ($file, $containerPath, $containersNamespace) {

                        $router->group([
                            // Routes Namespace
                            'namespace'  => $containersNamespace . '\\Containers\\' . basename($containerPath) . '\\Controllers\Api',
                            // Enable: API Rate Limiting
                            'middleware' => 'api.throttle',
                            // The API limit time.
                            'limit'      => env('API_LIMIT'),
                            // The API limit expiry time.
                            'expires'    => env('API_LIMIT_EXPIRES'),
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
        $webRoutesPath = $containerPath . '/Routes/Web';

        if (File::isDirectory($webRoutesPath)) {
            // get all files from the container Web routes directory
            $files = File::allFiles($webRoutesPath);

            foreach ($files as $file) {
                $this->webRouter->group([
                    'namespace' => $containersNamespace . '\\Containers\\' . basename($containerPath) . '\\Controllers\Web',
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
    private function getRouteFileVersionNumber($fileNameWithoutExtension)
    {
        $fileNameWithoutExtensionExploded = explode('.', $fileNameWithoutExtension);

        $apiVersionNumber = (int)end($fileNameWithoutExtensionExploded);

        return (is_int($apiVersionNumber) ? $apiVersionNumber : 1);
    }

}
