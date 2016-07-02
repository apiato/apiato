<?php

namespace App\Kernel\Controller\Abstracts;

use App\Kernel\Butler\Portals\KernelButler;
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
     * @param \App\Kernel\Butler\Portals\KernelButler $containersConfig
     */
    public function __construct(View $view, KernelButler $containersConfig)
    {
        $this->loadContainersViewsDirectories($view, $containersConfig);
    }

}
