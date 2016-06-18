<?php

namespace App\Containers\Core\Controller\Abstracts;

use App\Containers\Core\Controller\Contracts\WebControllerInterface;
use App\Services\Configuration\Portals\ContainersConfigReaderService;
use Illuminate\View\Factory as View;

/**
 * Class WebController.
 *
 * @author  Mahmoud Zalt <mahmoud@zalt.me>
 */
abstract class WebController extends CoreController implements WebControllerInterface
{

    /**
     * @var  \Illuminate\View\Factory
     */
    private $view;

    /**
     * @var  \App\Services\Configuration\Portals\ContainersConfigReaderService
     */
    private $containersConfig;

    /**
     * WebController constructor.
     *
     * @param \Illuminate\View\Factory                                         $view
     * @param \App\Services\Configuration\Portals\ContainersConfigReaderService $containersConfig
     */
    public function __construct(View $view, ContainersConfigReaderService $containersConfig)
    {
        $this->view = $view;
        $this->containersConfig = $containersConfig;

        $this->loadContainersViewsDirectories();
    }

    /**
     * Automatically load all the containers views directories
     */
    private function loadContainersViewsDirectories()
    {
        foreach ($this->containersConfig->getContainersNames() as $moduleName) {
            $moduleViewDirectory = base_path('app/Containers/' . $moduleName . '/Views/');
            if (is_dir($moduleViewDirectory)) {
                $this->view->addLocation($moduleViewDirectory);
            }
        }

    }

}
