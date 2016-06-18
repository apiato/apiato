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
    private $modulesConfig;

    /**
     * WebController constructor.
     *
     * @param \Illuminate\View\Factory                                         $view
     * @param \App\Services\Configuration\Portals\ContainersConfigReaderService $modulesConfig
     */
    public function __construct(View $view, ContainersConfigReaderService $modulesConfig)
    {
        $this->view = $view;
        $this->modulesConfig = $modulesConfig;

        $this->loadContainersViewsDirectories();
    }

    /**
     * Automatically load all the modules views directories
     */
    private function loadContainersViewsDirectories()
    {
        foreach ($this->modulesConfig->getContainersNames() as $moduleName) {
            $moduleViewDirectory = base_path('app/Containers/' . $moduleName . '/Views/');
            if (is_dir($moduleViewDirectory)) {
                $this->view->addLocation($moduleViewDirectory);
            }
        }

    }

}
