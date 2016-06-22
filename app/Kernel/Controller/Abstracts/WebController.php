<?php

namespace App\Kernel\Controller\Abstracts;

use App\Kernel\Configuration\Portals\MegavelConfigReaderService;
use App\Kernel\Controller\Contracts\WebControllerInterface;
use App\Kernel\Views\Traits\ViewsTrait;
use Illuminate\View\Factory as View;

/**
 * Class WebController.
 *
 * @author  Mahmoud Zalt <mahmoud@zalt.me>
 */
abstract class WebController extends KernelController implements WebControllerInterface
{

    use ViewsTrait;

    /**
     * WebController constructor.
     *
     * @param \Illuminate\View\Factory                                     $view
     * @param \App\Kernel\Configuration\Portals\MegavelConfigReaderService $containersConfig
     */
    public function __construct(View $view, MegavelConfigReaderService $containersConfig)
    {
        $this->loadContainersViewsDirectories($view, $containersConfig);
    }

}
