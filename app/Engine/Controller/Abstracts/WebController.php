<?php

namespace App\Engine\Controller\Abstracts;

use App\Engine\Controller\Contracts\WebControllerInterface;
use App\Engine\Views\Traits\ViewsTrait;
use App\Services\Configuration\Portals\MegavelConfigReaderService;
use Illuminate\View\Factory as View;

/**
 * Class WebController.
 *
 * @author  Mahmoud Zalt <mahmoud@zalt.me>
 */
abstract class WebController extends EngineController implements WebControllerInterface
{

    use ViewsTrait;

    /**
     * WebController constructor.
     *
     * @param \Illuminate\View\Factory                                          $view
     * @param \App\Services\Configuration\Portals\MegavelConfigReaderService $containersConfig
     */
    public function __construct(View $view, MegavelConfigReaderService $containersConfig)
    {
        $this->loadContainersViewsDirectories($view, $containersConfig);
    }

}
