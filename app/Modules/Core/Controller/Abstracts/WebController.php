<?php

namespace Hello\Modules\Core\Controller\Abstracts;

use Hello\Modules\Core\Controller\Contracts\WebControllerInterface;
use Hello\Services\Configuration\Portals\ModulesConfigReaderService;
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
     * @var  \Hello\Services\Configuration\Portals\ModulesConfigReaderService
     */
    private $modulesConfig;

    /**
     * WebController constructor.
     *
     * @param \Illuminate\View\Factory                                         $view
     * @param \Hello\Services\Configuration\Portals\ModulesConfigReaderService $modulesConfig
     */
    public function __construct(View $view, ModulesConfigReaderService $modulesConfig)
    {
        $this->view = $view;
        $this->modulesConfig = $modulesConfig;

        $this->loadModulesViewsDirectories();
    }

    /**
     * Automatically load all the modules views directories
     */
    private function loadModulesViewsDirectories()
    {
        foreach ($this->modulesConfig->getModulesNames() as $moduleName) {
            $moduleViewDirectory = base_path('app/Modules/' . $moduleName . '/Views/');
            if (is_dir($moduleViewDirectory)) {
                $this->view->addLocation($moduleViewDirectory);
            }
        }

    }

}
